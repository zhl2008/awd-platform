module.exports = {
    index: function(req, res, next) {
        var category = req.param("id");
        if (!category) {
            return res.notFound();
        }
        res.locals.currentMenu = category;
        res.locals.theme = "default";
        res.locals.view = category;
        return res.templet({});
    }
};