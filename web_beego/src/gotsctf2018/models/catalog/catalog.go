package catalog

import (
	"fmt"
	"github.com/astaxie/beego/orm"
	. "gotsctf2018/models"
)

func OneById(id int64) *Catalog {
	if id == 0 {
		return nil
	}

	if cp := OneByIdInDB(id); cp != nil {
		return cp
	} else {
		return nil
	}
}

func OneByIdInDB(id int64) *Catalog {
	if id == 0 {
		return nil
	}

	c := Catalog{Id: id}
	err := orm.NewOrm().Read(&c, "Id")
	if err != nil {
		return nil
	}
	return &c
}

func IdByIdent(ident string) int64 {
	if ident == "" {
		return 0
	}

	if cp := OneByIdentInDB(ident); cp != nil {
		return cp.Id
	} else {
		return 0
	}
}

func IdentExists(ident string) bool {
	id := IdByIdent(ident)
	return id > 0
}

func OneByIdent(ident string) *Catalog {
	id := IdByIdent(ident)
	return OneById(id)
}

func OneByIdentInDB(ident string) *Catalog {
	if ident == "" {
		return nil
	}

	c := Catalog{Ident: ident}
	err := orm.NewOrm().Read(&c, "Ident")
	if err != nil {
		return nil
	}

	return &c
}

func AllIdsInDB() []int64 {
	var catalogs []Catalog
	Catalogs().OrderBy("-DisplayOrder").All(&catalogs, "Id")
	size := len(catalogs)
	if size == 0 {
		return []int64{}
	}

	ret := make([]int64, size)
	for i := 0; i < size; i++ {
		ret[i] = catalogs[i].Id
	}

	return ret
}

func AllIds() []int64 {
	if ids := AllIdsInDB(); len(ids) != 0 {
		return ids
	} else {
		return []int64{}
	}
}

func All() []*Catalog {
	ids := AllIds()
	size := len(ids)
	if size == 0 {
		return []*Catalog{}
	}

	ret := make([]*Catalog, size)
	for i := 0; i < size; i++ {
		ret[i] = OneById(ids[i])
	}
	return ret
}

func Save(this *Catalog) (int64, error) {
	if IdentExists(this.Ident) {
		return 0, fmt.Errorf("catalog english identity exists")
	}
	num, err := orm.NewOrm().Insert(this)

	return num, err
}

func Del(c *Catalog) error {
	_, err := orm.NewOrm().Delete(c)
	if err != nil {
		return err
	}

	return nil
}

func Update(this *Catalog) error {
	if this.Id == 0 {
		return fmt.Errorf("primary key id not set")
	}
	_, err := orm.NewOrm().Update(this)
	return err
}

func Catalogs() orm.QuerySeter {
	return orm.NewOrm().QueryTable(new(Catalog))
}
