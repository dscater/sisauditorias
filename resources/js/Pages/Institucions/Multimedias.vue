<script>
const breadbrums = [
    {
        title: "Inicio",
        disabled: false,
        url: route("inicio"),
        name_url: "inicio",
    },
    {
        title: "Multimedias",
        disabled: false,
        url: "",
        name_url: "",
    },
];
</script>
<script setup>
import BreadBrums from "@/Components/BreadBrums.vue";
import { useApp } from "@/composables/useApp";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { useMenu } from "@/composables/useMenu";

const { flash } = usePage().props;
const props = defineProps({
    multimedias: {
        type: Array,
        default: [],
    },
});
const { mobile, identificaDispositivo } = useMenu();
const { setLoading } = useApp();

let form = useForm({
    multimedias: props.multimedias,
    eliminados: [],
});

const guardarMultimedias = () => {
    form.post(route("multimedias.store"), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Correcto",
                text: `${flash.bien ? flash.bien : "Proceso realizado"}`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            window.location.reload();
        },
        onError: (err) => {
            Swal.fire({
                icon: "info",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.error
                        ? err.error
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
        },
    });
};

function cargaArchivo(e, index) {
    form.multimedias[index]["archivo"] = null;
    form.multimedias[index]["archivo"] = e.target.files[0];
}

const agregarMultimedia = () => {
    if (form.multimedias.length < 4) {
        form.multimedias.push({
            id: 0,
            titulo: "",
            archivo: "",
            tipo: "",
            url_archivo: "",
        });
    }
    // else {
    //     Swal.fire({
    //         icon: "info",
    //         title: "Atención",
    //         text: `${
    //             flash.error
    //                 ? flash.error
    //                 : err.error
    //                 ? err.error
    //                 : "Error al obtener los registros"
    //         }`,
    //         confirmButtonColor: "#3085d6",
    //         confirmButtonText: `Aceptar`,
    //     });
    // }
};

const eliminarMultimedia = (index) => {
    if (form.multimedias[index].id != 0) {
        form.eliminados.push(form.multimedias[index].id);
    }
    form.multimedias.splice(index, 1);
};

onMounted(() => {
    identificaDispositivo();
    setTimeout(() => {
        setLoading(false);
    }, 300);
});
</script>
<template>
    <Head title="Multimedias"></Head>
    <v-container>
        <BreadBrums :breadbrums="breadbrums"></BreadBrums>
        <v-row class="mt-0">
            <v-col cols="12">
                <v-card flat>
                    <v-card-title class="border-b">
                        <v-row>
                            <v-col cols="12"
                                ><span class="text-body-2"
                                    >{{ form.multimedias.length }} de 4
                                    multimedias</span
                                ></v-col
                            >
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col
                                cols="12"
                                v-for="(item, index) in form.multimedias"
                            >
                                <v-row
                                    class="border pa-2 ma-3 mb-0 mt-2 multimedia"
                                >
                                    <button
                                        class="eliminar"
                                        @click="eliminarMultimedia(index)"
                                    >
                                        X
                                    </button>
                                    <v-col cols="12" md="8" xl="9">
                                        <v-text-field
                                            :hide-details="
                                                form.errors?.titulo
                                                    ? false
                                                    : true
                                            "
                                            :error="
                                                form.errors?.titulo
                                                    ? true
                                                    : false
                                            "
                                            :error-messages="
                                                form.errors?.titulo
                                                    ? form.errors?.titulo
                                                    : ''
                                            "
                                            density="compact"
                                            variant="outlined"
                                            label="Título"
                                            v-model="item.titulo"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="4" xl="3">
                                        <v-file-input
                                            :hide-details="
                                                form.errors?.archivo
                                                    ? false
                                                    : true
                                            "
                                            :error="
                                                form.errors?.archivo
                                                    ? true
                                                    : false
                                            "
                                            :error-messages="
                                                form.errors?.archivo
                                                    ? form.errors?.archivo
                                                    : ''
                                            "
                                            density="compact"
                                            variant="outlined"
                                            placeholder="Archivo"
                                            prepend-icon="mdi-camera"
                                            label="Archivo"
                                            @change="
                                                cargaArchivo($event, index)
                                            "
                                        ></v-file-input>
                                    </v-col>
                                    <v-col
                                        cols="12"
                                        md="8"
                                        xl="6"
                                        class="contenedor_multimedia mx-auto"
                                        v-if="item.url_archivo"
                                    >
                                        <img
                                            v-if="item.tipo == 'imagen'"
                                            :src="item.url_archivo"
                                            alt="Imagen"
                                        />
                                        <video
                                            v-else
                                            controls
                                            :src="item.url_archivo"
                                        ></video>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>

                        <v-row
                            class="border-t pt-1 mt-10"
                            v-if="props.multimedias.length > 0 || form.multimedias.length > 0"
                        >
                            <v-col cols="12">
                                <v-btn
                                    class="bg-principal"
                                    block
                                    prepend-icon="mdi-content-save"
                                    @click="guardarMultimedias"
                                    >Guardar</v-btn
                                >
                            </v-col>
                        </v-row>

                        <v-row
                            class="border-t pt-1 mt-3"
                            v-if="form.multimedias.length < 4"
                        >
                            <v-col cols="12">
                                <v-btn
                                    block
                                    prepend-icon="mdi-plus"
                                    @click="agregarMultimedia"
                                    >Agregar</v-btn
                                >
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<style scoped>
.multimedia {
    position: relative;
}

button.eliminar {
    padding: 3px 8px;
    background-color: red;
    color: white;
    border-radius: 8px;
    position: absolute;
    top: -5px;
    right: -5px;
    font-weight: bold;
    cursor: pointer;
}

.contenedor_multimedia img,
.contenedor_multimedia video {
    width: 100%;
}
</style>
