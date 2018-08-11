/**
 * Admin/Type.js
 */

module.exports = {
    tableName: "slide",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        createtime: {
            type: "integer",
            columnName: "createtime"
        },
        description: {
            type: "text",
            columnName: "description"
        },
        lang: {
            type: "string",
            columnName: "lang"
        },
        listorder: {
            type: "integer",
            columnName: "listorder"
        },
        remark: {
            type: "text",
            columnName: "remark"
        },
        status: {
            type: "integer",
            columnName: "status"
        },
        thumb: {
            type: "string",
            columnName: "thumb"
        },
        title: {
            type: "string",
            columnName: "title"
        },
        type: {
            type: "integer",
            columnName: "type"
        },
        updatetime: {
            type: "integer",
            columnName: "updatetime"
        },
        url: {
            type: "string",
            columnName: "url"
        }
    }
};