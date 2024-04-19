<script>
import Inicio from "@/Layouts/Inicio.vue";
import { onMounted } from "vue";
export default {
    layout: Inicio,
};
</script>

<script setup>
import { useInstitucion } from "@/composables/institucion/useInstitucion";
import { ref } from "vue";
const props = defineProps({
    publicacions: {
        type: Array,
        default: [],
    },
    noticias: {
        type: Array,
        default: [],
    },
    multimedias: {
        type: Array,
        default: [],
    },
});

const { oInstitucion } = useInstitucion();
const url_asset = ref("/");

onMounted(() => {
    url_asset.value = url_assets;
});
</script>

<template>
    <Head title="Inicio" />
    <v-container>
        <v-card class="mb-4">
            <v-card-text class="bg-secundario">
                <v-row>
                    <v-col
                        cols="12"
                        class="d-flex justify-space-between justify-sm-space-center align-center w-100"
                    >
                        <h2
                            class="text-h4 font-weight-bold text-white text-center w-100"
                        >
                            CONTACTOS
                        </h2>
                    </v-col>
                    <v-col cols="12" md="4">
                        <p>
                            <strong>Ciudad: </strong>{{ oInstitucion.ciudad }}
                        </p>
                    </v-col>
                    <v-col cols="12" md="4">
                        <p>
                            <strong>Dirección: </strong>{{ oInstitucion.dir }}
                        </p>
                    </v-col>
                    <v-col cols="12" md="4">
                        <p>
                            <strong>Teléfonos: </strong>{{ oInstitucion.fonos }}
                        </p>
                    </v-col>
                    <v-col cols="12" md="4">
                        <p>
                            <strong>Horarios de Atención: </strong
                            >{{ oInstitucion.horarios }}
                        </p>
                    </v-col>
                    <v-col cols="12" md="4">
                        <p>
                            <strong>Correo Electrónico: </strong
                            >{{ oInstitucion.correo }}
                        </p>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-card class="mt-3">
            <v-card-text>
                <v-row>
                    <v-col cols="12" v-html="oInstitucion.ubicacion_google">
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<style scoped></style>
