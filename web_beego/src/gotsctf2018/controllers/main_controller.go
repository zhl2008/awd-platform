package controllers

import (
	"gotsctf2018/g"
	"gotsctf2018/models/blog"
	"gotsctf2018/models/catalog"
)

type MainController struct {
	BaseController
}

func (this *MainController) Get() {
	this.Data["Catalogs"] = catalog.All()
	this.Data["PageTitle"] = "首页"
	this.Layout = "layout/default.html"
	this.TplName = "index.html"
}

func (this *MainController) Read() {
	ident := this.GetString(":ident")
	b := blog.OneByIdent(ident)
	if b == nil {
		this.Abort("404")
		return
	}

	b.Views = b.Views + 1
	blog.Update(b, "")

	this.Data["Blog"] = b
	this.Data["Content"] = g.RenderMarkdown(blog.ReadBlogContent(b).Content)
	this.Data["PageTitle"] = b.Title
	this.Data["Catalog"] = catalog.OneById(b.CatalogId)
	this.Layout = "layout/default.html"
	this.TplName = "article/read.html"
}

func (this *MainController) ListByCatalog() {
	cata := this.Ctx.Input.Param(":ident")
	if cata == "" {
		this.Abort("400")
		return
	}

	limit := this.GetIntWithDefault("limit", 10)

	c := catalog.OneByIdent(cata)
	if c == nil {
		this.Abort("404")
		return
	}

	ids := blog.Ids(c.Id)
	pager := this.SetPaginator(limit, int64(len(ids)))
	blogs := blog.ByCatalog(c.Id, pager.Offset(), limit)

	this.Data["Catalog"] = c
	this.Data["Blogs"] = blogs
	this.Data["PageTitle"] = c.Name

	this.Layout = "layout/default.html"
	this.TplName = "article/by_catalog.html"
}
