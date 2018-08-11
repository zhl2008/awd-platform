/**
 * Admin/online.js
 */
module.exports = {
    tableName: "online",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
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
        title: {
            type: "string",
            columnName: "title"
        },
        type: {
            type: "string",
            columnName: "type"
        }
    }
};