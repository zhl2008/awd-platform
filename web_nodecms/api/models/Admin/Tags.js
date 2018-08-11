/**
 * Admin/tags.js
 */
module.exports = {
    tableName: "tags",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        lang: {
            type: "string",
            columnName: "lang"
        },
        listorder: {
            type: "integer",
            columnName: "listorder"
        },
        status: {
            type: "integer",
            columnName: "status"
        },
        title: {
            type: "string",
            columnName: "title"
        },
        url: {
            type: "string",
            columnName: "url"
        }
    }
};