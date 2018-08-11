/**
 * Admin/Article.js
 */

module.exports = {
    tableName: "article",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        category: {
            type: "integer",
            columnName: "category"
        },
        color: {
            type: "string",
            columnName: "color"
        },
        content: {
            type: "text",
            columnName: "content"
        },
        copyfrom: {
            type: "string",
            columnName: "copyfrom"
        },
        createtime: {
            type: "integer",
            columnName: "createtime"
        },
        description: {
            type: "text",
            columnName: "description"
        },
        fromlink: {
            type: "string",
            columnName: "fromlink"
        },
        hits: {
            type: "integer",
            columnName: "hits"
        },
        isbold: {
            type: "integer",
            columnName: "isbold"
        },
        keywords: {
            type: "string",
            columnName: "keywords"
        },
        lang: {
            type: "string",
            columnName: "lang"
        },
        listorder: {
            type: "integer",
            columnName: "listorder"
        },
        puttime: {
            type: "integer",
            columnName: "puttime"
        },
        realhits: {
            type: "integer",
            columnName: "realhits"
        },
        recommends: {
            type: "string",
            columnName: "recommends"
        },
        status: {
            type: "integer",
            columnName: "status"
        },
        tags: {
            type: "string",
            columnName: "tags"
        },
        thumb: {
            type: "string",
            columnName: "thumb"
        },
        title: {
            type: "string",
            columnName: "title"
        },
        tpl: {
            type: "string",
            columnName: "tpl"
        },
        uid: {
            type: "integer",
            columnName: "uid"
        },
        updatetime: {
            type: "integer",
            columnName: "updatetime"
        }
    }
};