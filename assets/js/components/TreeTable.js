import VueCharacter from "./TreeTable.vue";
import Vue from "vue";

export default function TreeTable(element, data) {
    new Vue({
        el: element,
        data: data,
        ...VueCharacter
    });
}