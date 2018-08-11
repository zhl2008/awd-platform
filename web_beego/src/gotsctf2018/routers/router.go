package routers

import (
	"github.com/astaxie/beego"
	"gotsctf2018/controllers"
)

func init() {

	beego.Router("/api/health", &controllers.ApiController{}, "get:Health;post:Health")
	beego.Router("/api/markdown", &controllers.ApiController{}, "get:Markdown;post:Markdown")
	beego.Router("/api/upload", &controllers.ApiController{}, "get:Upload;post:Upload")

	beego.Router("/", &controllers.MainController{})
	beego.Router("/article/:ident", &controllers.MainController{}, "get:Read")
	beego.Router("/catalog/:ident", &controllers.MainController{}, "get:ListByCatalog")

	beego.Router("/login", &controllers.LoginController{}, "get:Login;post:DoLogin")
	beego.Router("/logout", &controllers.LoginController{}, "get:Logout")

	beego.Router("/me", &controllers.MeController{}, "get:Default")
	beego.Router("/me/catalog/add", &controllers.CatalogController{}, "get:Add;post:DoAdd")
	beego.Router("/me/catalog/edit", &controllers.CatalogController{}, "get:Edit;post:DoEdit")
	beego.Router("/me/catalog/del", &controllers.CatalogController{}, "get:Del")
	beego.Router("/me/article/add", &controllers.ArticleController{}, "get:Add;post:DoAdd")
	beego.Router("/me/article/edit", &controllers.ArticleController{}, "get:Edit;post:DoEdit")
	beego.Router("/me/article/del", &controllers.ArticleController{}, "get:Del")
	beego.Router("/me/article/draft", &controllers.ArticleController{}, "get:Draft")
}
