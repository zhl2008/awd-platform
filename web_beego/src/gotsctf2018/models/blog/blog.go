package blog

import (
	"fmt"
	"github.com/astaxie/beego/orm"
	. "gotsctf2018/models"
	"time"
	"html/template"
)

func OneById(id int64) *Blog {
	if id <= 0 {
		return nil
	}

	if p := OneByIdInDB(id); p != nil {
		return p
	}
	return nil
}

func OneByIdInDB(id int64) *Blog {
	if id <= 0 {
		return nil
	}

	o := Blog{Id: id}
	err := orm.NewOrm().Read(&o, "Id")
	if err != nil {
		return nil
	}
	return &o
}

func IdByIdent(ident string) int64 {
	if ident == "" {
		return 0
	}

	if p := OneByIdentInDB(ident); p != nil {
		return p.Id
	} else {
		return 0
	}
}

func IdentExists(ident string) bool {
	id := IdByIdent(ident)
	return id > 0
}

func OneByIdent(ident string) *Blog {
	id := IdByIdent(ident)
	return OneById(id)
}

func OneByIdentInDB(ident string) *Blog {
	if ident == "" {
		return nil
	}

	c := Blog{Ident: ident}
	err := orm.NewOrm().Read(&c, "Ident")
	if err != nil {
		return nil
	}

	return &c
}

func IdsInDB(catalog_id int64) []int64 {
	if catalog_id <= 0 {
		return []int64{}
	}

	var blogs []Blog
	Blogs().Filter("CatalogId", catalog_id).Filter("Status", 1).OrderBy("-Created").All(&blogs, "Id")
	size := len(blogs)
	if size == 0 {
		return []int64{}
	}

	ret := make([]int64, size)
	for i := 0; i < size; i++ {
		ret[i] = blogs[i].Id
	}

	return ret
}

func ReadBlogContent(b *Blog) *BlogContent {
	if b.Id <= 0 || b.BlogContentId <= 0 {
		return nil
	}

	if p := readBlogContentInDB(b); p != nil {
		return p
	}
	return nil
}

func readBlogContentInDB(b *Blog) *BlogContent {
	o := BlogContent{Id: b.BlogContentId}
	err := orm.NewOrm().Read(&o, "Id")
	if err != nil {
		return nil
	}
	o.HTMLContent = template.HTML(o.Content)
	return &o
}

func Ids(catalog_id int64) []int64 {
	if catalog_id <= 0 {
		return []int64{}
	}

	if ids := IdsInDB(catalog_id); len(ids) != 0 {
		return ids
	} else {
		return []int64{}
	}
}

func ByCatalog(catalog_id int64, offset, limit int) []*Blog {
	ids := Ids(catalog_id)
	size := len(ids)
	if size == 0 {
		return []*Blog{}
	}

	if size > limit {
		end := offset + limit
		if end > size {
			end = size
		}

		ids = ids[offset:end]
	}

	size = len(ids)
	ret := make([]*Blog, size)
	for i := 0; i < size; i++ {
		ret[i] = OneById(ids[i])
		ret[i].Content = ReadBlogContent(ret[i])
	}
	return ret
}

func Save(this *Blog, blogContent string) (int64, error) {
	if IdentExists(this.Ident) {
		return 0, fmt.Errorf("blog english identity exists")
	}

	bc := &BlogContent{Content: blogContent}
	or := orm.NewOrm()
	blogContentId, e := or.Insert(bc)
	if e != nil {
		return 0, e
	}

	this.BlogContentId = blogContentId
	this.BlogContentLastUpdate = time.Now().Unix()

	id, err := or.Insert(this)

	return id, err
}

func Del(b *Blog) error {
	num, err := Blogs().Filter("Id", b.Id).Delete()
	if err != nil {
		return err
	}

	if num > 0 {
		BlogContents().Filter("Id", b.BlogContentId).Delete()
	}

	return nil
}

func Update(b *Blog, content string) error {
	if b.Id == 0 {
		return fmt.Errorf("primary key:id not set")
	}

	bc := ReadBlogContent(b)
	if content != "" && bc.Content != content {
		bc.Content = content
		_, e := orm.NewOrm().Update(bc)
		if e != nil {
			return e
		}
		b.BlogContentLastUpdate = time.Now().Unix()
	}

	_, err := orm.NewOrm().Update(b)
	return err
}

func Blogs() orm.QuerySeter {
	return orm.NewOrm().QueryTable(new(Blog))
}

func BlogContents() orm.QuerySeter {
	return orm.NewOrm().QueryTable(new(BlogContent))
}
