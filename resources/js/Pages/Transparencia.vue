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
    <v-container class="container_transparencia">
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
                            TRANSPARENCIA
                        </h2>
                    </v-col>
                    <v-col cols="12" md="4" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Administración
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.administracion"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="4" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Código de Ética
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.codigo_etica"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="4" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Información Financiera
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.informacion_financiera"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<style scoped>
#app .container_transparencia{
    min-height: 70vh!important;
}
</style>
