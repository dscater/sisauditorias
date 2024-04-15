import { defineStore } from "pinia";

export const useInstitucionStore = defineStore("institucion", {
    state: () => ({
        oInstitucion: {
            institucion: "",
            nombre_sistema: "",
            nit: "",
            img_organigrama: "",
            mision: "",
            vision: "",
            principios: "",
            valores: "",
            administracion: "",
            codigo_etica: "",
            informacion_financiera: "",
            ubicacion_google: "",
            ciudad: "",
            dir: "",
            fonos: "",
            horario: "",
            correo: "",
            logo: "",
            // appends
            iniciales_nombre: "",
            url_logo: "",
            url_img_organigrama: "",
        },
    }),
    actions: {
        setInstiticion(value) {
            this.oInstitucion = value;
        },
    },
});
