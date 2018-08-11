/**
 * Admin/Type.js
 */

module.exports = {
    tableName: "type",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        "class": {
            type: "string",
            columnName: "class"
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
        }
    }
};