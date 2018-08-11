package controllers

import (
	"gotsctf2018/models"
	"gotsctf2018/models/blog"
	"gotsctf2018/models/catalog"
)

type ArticleController struct {
	BaseController
}

func (this *ArticleController) Draft() {
	var blogs []*models.Blog
	blog.Blogs().Filter("Status", 0).All(&blogs)
	this.Data["Blogs"] = blogs
	this.Layout = "layout/admin.html"
	this.TplName = "article/draft.html"
}

func (this *ArticleController) Add() {
	this.Data["Catalogs"] = catalog.All()
	this.Data["IsPost"] = true
	this.Layout = "layout/admin.html"
	this.TplName = "article/add.html"
	this.JsStorage("deleteKey", "post/new")
}

func (this *ArticleController) DoAdd() {
	title := this.GetString("title")
	ident := this.GetString("ident")
	keywords := this.GetString("keywords")
	catalog_id := this.GetIntWithDefault("catalog_id", -1)
	aType := this.GetIntWithDefault("type", -1)
	status := this.GetIntWithDefault("status", -1)
	content := this.GetString("content")

	if catalog_id == -1 || aType == -1 || status == -1 {
		this.Abort("400")
		return
	}

	if title == "" || ident == "" {
		this.Abort("400")
		return
	}

	cp := catalog.OneById(int64(catalog_id))
	if cp == nil {
		this.Abort("404")
		return
	}

	b := &models.Blog{Ident: ident, Title: title, Keywords: keywords, CatalogId: int64(catalog_id), Type: int8(aType), Status: int8(status)}
	_, err := blog.Save(b, content)

	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	this.JsStorage("deleteKey", "post/new")
	this.Ctx.ResponseWriter.Header().Add("Refresh", "1; url=/catalog/"+cp.Ident)
	this.Ctx.WriteString("Add success")
}

func (this *ArticleController) Edit() {
	id, err := this.GetInt("id")
	if err != nil {
		this.Abort("400")
		return
	}

	b := blog.OneById(int64(id))
	if b == nil {
		this.Abort("404")
		return
	}

	this.Data["Content"] = blog.ReadBlogContent(b).Content
	this.Data["Blog"] = b
	this.Data["Catalogs"] = catalog.All()
	this.Layout = "layout/admin.html"
	this.TplName = "article/edit.html"
}

func (this *ArticleController) DoEdit() {
	id, err := this.GetInt("id")
	if err != nil {
		this.Abort("400")
		return
	}

	b := blog.OneById(int64(id))
	if b == nil {
		this.Abort("404")
		return
	}

	title := this.GetString("title")
	ident := this.GetString("ident")
	keywords := this.GetString("keywords")
	catalog_id := this.GetIntWithDefault("catalog_id", -1)
	aType := this.GetIntWithDefault("type", -1)
	status := this.GetIntWithDefault("status", -1)
	content := this.GetString("content")

	if catalog_id == -1 || aType == -1 || status == -1 {
		this.Ctx.WriteString("catalog || type || status is illegal")
		return
	}

	if title == "" || ident == "" {
		this.Ctx.WriteString("title or ident is blank")
		return
	}

	cp := catalog.OneById(int64(catalog_id))
	if cp == nil {
		this.Ctx.WriteString("catalog_id not exists")
		return
	}

	b.Ident = ident
	b.Title = title
	b.Keywords = keywords
	b.CatalogId = int64(catalog_id)
	b.Type = int8(aType)
	b.Status = int8(status)

	err = blog.Update(b, content)

	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	this.JsStorage("deleteKey", "post/edit")
	this.Ctx.ResponseWriter.Header().Add("Refresh", "1; url=/catalog/"+cp.Ident)
	this.Ctx.WriteString("Edit success")
}

func (this *ArticleController) Del() {
	id, err := this.GetInt("id")
	if err != nil {
		this.Abort("400")
		return
	}

	b := blog.OneById(int64(id))
	if b == nil {
		this.Abort("404")
		return
	}

	err = blog.Del(b)
	if err != nil {
		this.Ctx.WriteString(err.Error())
		return
	}

	this.Ctx.ResponseWriter.Header().Add("Refresh", "1; url=/")
	this.Ctx.WriteString("Del success")
}
