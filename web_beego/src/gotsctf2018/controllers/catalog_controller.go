package controllers

import (
	"fmt"
	"gotsctf2018/models"
	"gotsctf2018/models/catalog"
	"github.com/ulricqin/goutils/filetool"
	"time"
)

const (
	CATALOG_IMG_DIR = "static/uploads/usercontents/catalogs"
)

type CatalogController struct {
	AdminController
}

func (this *CatalogController) Add() {
	this.Data["IsAddCatalog"] = true
	this.Layout = "layout/admin.html"
	this.TplName = "catalog/add.html"
}

func (this *CatalogController) Edit() {
	id, err := this.GetInt("id")
	if err != nil {
		this.Ctx.WriteString("param id should be digit")
		return
	}

	c := catalog.OneById(int64(id))
	if c == nil {
		this.Abort("404")
		return
	}

	this.Data["Catalog"] = c
	this.Layout = "layout/admin.html"
	this.TplName = "catalog/edit.html"
}

func (this *CatalogController) Del() {
	id, err := this.GetInt("id")
	if err != nil {
		this.Ctx.WriteString("param id should be digit")
		return
	}

	c := catalog.OneById(int64(id))
	if c == nil {
		this.Abort("404")
		return
	}

	err = catalog.Del(c)
	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	this.Ctx.ResponseWriter.Header().Add("Refresh", "1; url=/")
	this.Ctx.WriteString("Del success")
}

func (this *CatalogController) extractCatalog(imgMust bool) (*models.Catalog, error) {
	o := &models.Catalog{}
	o.Name = this.GetString("name")
	o.Ident = this.GetString("ident")
	o.Resume = this.GetString("resume")
	o.DisplayOrder = this.GetIntWithDefault("display_order", 0)

	if o.Name == "" {
		return nil, fmt.Errorf("name is blank")
	}

	if o.Ident == "" {
		return nil, fmt.Errorf("ident is blank")
	}

	_, header, err := this.GetFile("img")
	if err != nil && imgMust {
		return nil, err
	}

	if err == nil {
		ext := filetool.Ext(header.Filename)
		if ext == "" {
			o.ImgUrl = ""
			return o, nil
		}
		imgPath := fmt.Sprintf("%s/%s_%d%s", CATALOG_IMG_DIR, o.Ident, time.Now().Unix(), ext)

		filetool.InsureDir(CATALOG_IMG_DIR)
		err = this.SaveToFile("img", imgPath)
		if err != nil && imgMust {
			return nil, err
		}

		if err == nil {
			o.ImgUrl = "/" + imgPath
		}
	}

	return o, nil
}

func (this *CatalogController) DoEdit() {
	cid, err := this.GetInt("catalog_id")
	if err != nil {
		this.Ctx.WriteString("catalog_id is illegal")
		return
	}

	old := catalog.OneById(int64(cid))
	if old == nil {
		this.Ctx.WriteString(fmt.Sprintf("no such catalog_id: %d", cid))
		return
	}

	var o *models.Catalog
	o, err = this.extractCatalog(false)
	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	old.Ident = o.Ident
	old.Name = o.Name
	old.Resume = o.Resume
	old.DisplayOrder = o.DisplayOrder
	if o.ImgUrl != "" {
		old.ImgUrl = o.ImgUrl
	}

	if err = catalog.Update(old); err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	this.Ctx.ResponseWriter.Header().Add("Refresh", "1; url=/")
	this.Ctx.WriteString("Edit success")
}

func (this *CatalogController) DoAdd() {
	o, err := this.extractCatalog(true)
	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	_, err = catalog.Save(o)
	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	this.Ctx.ResponseWriter.Header().Add("Refresh", "1; url=/catalog/"+o.Ident)
	this.Ctx.WriteString("Add success")
}
