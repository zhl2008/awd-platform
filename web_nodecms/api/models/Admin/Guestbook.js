/**
 * Admin/Guestbook.js
 */

module.exports = {
    tableName: "guestbook",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        author: {
            type: "string",
            columnName: "author"
        },
        category: {
            type: "integer",
            columnName: "category"
        },
        content: {
            type: "text",
            columnName: "content"
        },
        createtime: {
            type: "integer",
            columnName: "createtime"
        },
        description: {
            type: "text",
            columnName: "description"
        },
        email: {
            type: "string",
            columnName: "email"
        },
        lang: {
            type: "string",
            columnName: "lang"
        },
        listorder: {
            type: "integer",
            columnName: "listorder"
        },
        phone: {
            type: "string",
            columnName: "phone"
        },
        replytime: {
            type: "integer",
            columnName: "replytime"
        },
        replyuid: {
            type: "integer",
            columnName: "replyuid"
        },
        status: {
            type: "integer",
            columnName: "status"
        },
        title: {
            type: "string",
            columnName: "title"
        },
        uid: {
            type: "integer",
            columnName: "uid"
        }
    }
};