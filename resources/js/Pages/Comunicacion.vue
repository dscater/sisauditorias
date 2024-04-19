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
                            COMUNICACIÓN
                        </h2>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-card>
            <v-card-text>
                <v-row>
                    <v-col cols="12" class="bg-principal">
                        <h4 class="text-h6 font-weight-bold text-center">
                            Publicaciones
                        </h4>
                    </v-col>
                    <v-col
                        cols="12"
                        md="3"
                        class="px-6"
                        v-for="value in props.publicacions"
                    >
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    {{ value.titulo }}
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="value.descripcion"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-card class="mt-3">
            <v-card-text>
                <v-row>
                    <v-col cols="12" class="bg-principal">
                        <h4 class="text-h6 font-weight-bold text-center">
                            Noticias
                        </h4>
                    </v-col>
                    <v-col
                        cols="12"
                        md="3"
                        class="px-6"
                        v-for="value in props.noticias"
                    >
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    {{ value.titulo }}
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="value.descripcion"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-card class="mt-3">
            <v-card-text>
                <v-row>
                    <v-col cols="12" class="bg-principal">
                        <h4 class="text-h6 font-weight-bold text-center">
                            Multimedia
                        </h4>
                    </v-col>
                    <v-col
                        cols="12"
                        md="3"
                        class="px-6"
                        v-for="value in props.multimedias"
                    >
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    {{ value.titulo }}
                                </h4>
                            </v-col>
                            <v-col cols="12" class="contenedor_multimedia">
                                <v-img v-if="value.tipo=='imagen'" :src="value.url_archivo"></v-img>
                                <video v-if="value.tipo=='video'" :src="value.url_archivo" controls></video>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<style scoped>
.contenedor_multimedia img,
.contenedor_multimedia video{
    width: 100%;
}
</style>
