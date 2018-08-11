/**
 * Admin/Navigation.js
 */

module.exports = {
    tableName: "navigation",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        color: {
            type: "string",
            columnName: "color"
        },
        lang: {
            type: "string",
            columnName: "lang"
        },
        listorder: {
            type: "integer",
            columnName: "listorder"
        },
        rel: {
            type: "string",
            columnName: "rel"
        },
        remark: {
            type: "string",
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
        url: {
            type: "string",
            columnName: "url"
        }
    }
};