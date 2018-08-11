/**
 * Admin/models.js
 */

module.exports = {
    tableName: 'model',
    autoCreatedAt: false,
    autoUpdatedAt: false,
    attributes: {
        "id": {
            type: 'integer',
            unique: true,
            primaryKey: true,
            columnName: 'id'
        },
        "varname": {
            type: 'string',
            columnName: 'varname'
        },
        "listorder": {
            type: 'integer',
            columnName: 'listorder'
        },
        "issearch": {
            type: 'integer',
            columnName: 'issearch'
        },
        "isrecommend": {
            type: 'integer',
            columnName: 'isrecommend'
        },
        "status": {
            type: 'integer',
            columnName: 'status'
        }
    }
};