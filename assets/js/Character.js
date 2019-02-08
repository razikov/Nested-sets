import VueCharacter from "./Character.vue";
import Vue from "vue";

export function Character(element, data) {
    new Vue({
        el: element,
        data: data,
        ...VueCharacter
    });
}