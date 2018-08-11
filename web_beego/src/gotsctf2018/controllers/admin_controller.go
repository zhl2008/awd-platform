package controllers

type AdminController struct {
	BaseController
}

func (this *AdminController) CheckLogin() {
	if !this.IsAdmin {
		this.Redirect("/login", 302)
	}
}
