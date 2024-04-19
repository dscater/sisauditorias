<script>
import Inicio from "@/Layouts/Inicio.vue";
import { onMounted } from "vue";
export default {
    layout: Inicio,
};
</script>

<script setup>
import { useInstitucion } from "@/composables/institucion/useInstitucion";
import { useForm, Head } from "@inertiajs/vue3";
import { ref } from "vue";

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
                        class="d-flex align-center w-100"
                    >
                       <div class="contenedor_info text-center  flex-fill">
                            <h1 class="text-h4 font-weight-bold text-white">
                                {{ oInstitucion.institucion }}
                            </h1>
                            <p class="text-caption">NIT: {{ oInstitucion.nit }}</p>
                            <p class="text-caption">{{ oInstitucion.dir }}</p>
                            <p class="text-caption">
                                {{ oInstitucion.fonos }}
                            </p>
                        </div>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-card>
            <v-card-text>
                <v-row>
                    <v-col cols="12" class="bg-principal">
                        <h4 class="text-h6 font-weight-bold text-center">
                            INSTITUCIÓN
                        </h4>
                    </v-col>
                    <v-col cols="12" md="3" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Misión
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.mision"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="3" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Visión
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.vision"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="3" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Principios
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.principios"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="3" class="px-6">
                        <v-row>
                            <v-col cols="12" class="pb-0">
                                <h4
                                    class="text-subtitle-2 font-weight-bold text-center"
                                >
                                    Valores
                                </h4>
                            </v-col>
                            <v-col cols="12">
                                <p
                                    class="text-caption text-justify text-capitalize text-capitalize"
                                    v-text="oInstitucion.valores"
                                ></p>
                            </v-col>
                        </v-row>
                    </v-col>

                    <v-col cols="12" md="6" class="mx-auto">
                        <h4
                            class="text-h6 font-weight-bold text-center bg-principal"
                        >
                            Organigrama
                        </h4>
                        <v-row>
                            <v-col cols="12">
                                <v-img
                                    :src="oInstitucion.url_img_organigrama"
                                    style="max-width: 100%"
                                ></v-img>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<style scoped></style>
