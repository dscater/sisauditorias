import { defineStore } from "pinia";

export const menuPortalStore = defineStore("menuPortal", {
    state: () => ({
        ruta_acutal: "portal.inicio",
    }),
    actions: {
        setActual(value) {
            this.ruta_acutal = value;
        },
    },
});
