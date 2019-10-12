<template>
    <table>
        <thead>
            <tr>
                <th v-for="col in columns">
                    {{ col.header }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in rows">
                <td v-for="col in columns">
                    {{ row[col.id] }}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        props: {
            columns: {// массив с колонками таблицы, [keyValue, headerName, valueType]
                type: Array,
                default: []
            },
            data: {// Массив исходных данных
                type: Array,
                default: []
            },
        },
        computed: {
            rows: function () {
                
                function parseData(data, columns, lvl = 0) {
                    var rows = []; 
                    data.forEach(function(item, i, arr) {
                        var row = {
                            "lvl": lvl,
                            "expanded": false,
                            "visible": true,
                            "selected": false,
                        };
                        columns.forEach(function(col, i, arr) {
                            row[col.id] = item[col.id];
                        })
                        rows.push(row);
                        if (item["data"]) {
                            let subRows = parseData(item["data"], columns, lvl + 1);
                            subRows.forEach(function(subRow, i, arr) {
                                rows.push(subRow);
                            })
                        }
                    })
                    return rows;
                }
                
                return parseData(this.data, this.columns);
            },
        },
        methods: {
            fGetAdvantages(container) {
                var advantageList = [];
                var _this = this;
                if (container.advantage_container) {
                    container.advantage_container.forEach(function (subContainer, i, arr) {
                        advantageList = advantageList.concat(_this.fGetAdvantages(subContainer));
                    });
                }
                if (container.advantage) {
                    container.advantage.forEach(function (advantage, i, arr) {
                        advantageList.push(advantage);
                    });
                }
                return advantageList;
            },
        },

    }
</script>

<style scoped>
    
</style>
