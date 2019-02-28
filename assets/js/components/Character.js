import VueCharacter from "./Character.vue";
import Vue from "vue";

export default function Character(element, data) {
    new Vue({
        el: element,
        data: data,
        ...VueCharacter
    });
}
