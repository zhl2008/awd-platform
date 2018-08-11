/**
 * Admin/fragment.js
 */
module.exports = {
    tableName: "fragment",
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        id: {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        content: {
            type: "text",
            columnName: "content"
        },
        createtime: {
            type: "integer",
            columnName: "createtime"
        },
        lang: {
            type: "string",
            columnName: "lang"
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
        updatetime: {
            type: "integer",
            columnName: "updatetime"
        },
        varname: {
            type: "string",
            columnName: "varname"
        }
    }
};