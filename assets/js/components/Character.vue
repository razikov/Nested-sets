<template>
    <div class="fieldset--row">
        <div class="row">
            <div class="col-sm-24 fieldset--col"> 
                <div class="fieldset--padding">
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            ST: {{ st + fGetAttributeBonusByName('st') }} ({{ (st - 10) * 10 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            DX: {{ dx + fGetAttributeBonusByName('dx')  }} ({{ (dx - 10) * 20 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            IQ: {{ iq + fGetAttributeBonusByName('iq')  }} ({{ (iq - 10) * 20 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            HT: {{ ht + fGetAttributeBonusByName('ht')  }} ({{ (ht - 10) * 10 }})
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            HP: {{ hitPoints }} ({{ hp * 2 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Will: {{ will + (iq + fGetAttributeBonusByName('iq')) + fGetAttributeBonusByName('will') }} ({{ will * 5 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Perception: {{ perception + (iq + fGetAttributeBonusByName('iq')) + fGetAttributeBonusByName('perception') }} ({{ perception * 5 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            FP: {{ fp + (ht + fGetAttributeBonusByName('ht')) + fGetAttributeBonusByName('fp') }} ({{ fp * 3 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            BS: {{ speed + Math.round(((ht + fGetAttributeBonusByName('ht')) + (dx + fGetAttributeBonusByName('dx')))/4) + fGetAttributeBonusByName('speed') }} ({{ speed * 5 }})
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            BM: {{ move + (speed + Math.round(((ht + fGetAttributeBonusByName('ht')) + (dx + fGetAttributeBonusByName('dx')))/4) + fGetAttributeBonusByName('speed')) + fGetAttributeBonusByName('move') }} ({{ move * 5 }})
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            baseLoad
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            load
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            burdenName
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            directDamage
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            amplitudeDamage
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            move
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Парирование: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Блок: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Уклонение: {{ speed + Math.round(((ht + fGetAttributeBonusByName('ht')) + (dx + fGetAttributeBonusByName('dx')))/4) + fGetAttributeBonusByName('speed') + 3 }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        Очков: 
                    </div>
                    <hr>
                    <div class="row">
                        <ul>
                            <li v-for="advantage in advantageList">
                                {{ advantage.name.value }}
                            </li>
                        </ul>
                    </div>
                    <TreeTable :data="treeData" :columns="treeColumns"></TreeTable>
                </div>
            </div>
        </div>
        <div>
            <br>
        </div>
    </div>
</template>

<script>
    import TreeTable from "./TreeTable.vue";
    
    export default {
        components: {
            TreeTable
        },
        computed: {
            hitPoints: function () {
                return this.hp + this.st + this.fGetAttributeBonusByName('st');
            },
            advantageList: function () {
                // Название, стоимость, ссылка. ДрагДроп, Сортировка, Фильтрация
                return this.fGetAdvantages(this.advantage_list);
            },
            treeData: function() {
                return [
                    {"id":"1", "value":"The Shawshank Redemption", "open":true, "data":[
                        {"id":"1.1", "value":"Part 1", "chapter":"alpha"},
                        {"id":"1.2", "value":"Part 2", "chapter":"beta", "open":true, "data":[
                            {"id":"1.2.1", "value":"Part 1", "chapter":"beta-twin"}
                        ]}
                    ]}
                  ];
            },
            treeColumns: function() {
                return [
                    {id:"id", header:"#"},
                    {id:"value", header:"Film title"},
                    {id:"chapter", header:"Mode"}
                ];
            },
        },
        
        methods: {
            
            fGetAdvantages(container) {
                var advantageList = [];
                var _this = this;
                if (container.advantage_container) {
                    container.advantage_container.forEach(function(subContainer, i, arr) {
                        advantageList = advantageList.concat(_this.fGetAdvantages(subContainer));
                    });
                }
                if (container.advantage) {
                    container.advantage.forEach(function(advantage, i, arr) {
                        advantageList.push(advantage);
                    });
                }
                return advantageList;
            },
            
            fGetBonusList(advantageList) {
                var bonusList = [];
                advantageList.forEach(function(advantage, i, arr) {
                    bonusList = bonusList.concat(advantage.attribute_bonus);
                });
                return bonusList;
            },
            
            fGetAttributeBonusByName(name) {
                var result = 0;
                var bonusList = this.fGetBonusList(this.advantageList);
                bonusList.forEach(function(bonus, i, arr) {
                    if (bonus && (bonus.attribute.value == name)) {
                        result += parseInt(bonus.amount.value);
                    }
                })
//                console.log(name, result);
                return result;
            }
        },
        
    }
</script>

<style scoped>
    
</style>
