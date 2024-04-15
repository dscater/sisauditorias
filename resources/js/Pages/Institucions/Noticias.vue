<script>
const breadbrums = [
    {
        title: "Inicio",
        disabled: false,
        url: route("inicio"),
        name_url: "inicio",
    },
    {
        title: "Noticias",
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
    noticias: {
        type: Array,
        default: [],
    },
});
const { mobile, identificaDispositivo } = useMenu();
const { setLoading } = useApp();

let form = useForm({
    noticias: props.noticias,
    eliminados: [],
});

const guardarNoticias = () => {
    form.post(route("noticias.store"), {
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

const agregarNoticia = () => {
    if (form.noticias.length < 4) {
        form.noticias.push({
            id: 0,
            titulo: "",
            descripcion: "",
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

const eliminarNoticia = (index) => {
    if (form.noticias[index].id != 0) {
        form.eliminados.push(form.noticias[index].id);
    }
    form.noticias.splice(index, 1);
};

onMounted(() => {
    identificaDispositivo();
    setTimeout(() => {
        setLoading(false);
    }, 300);
});
</script>
<template>
    <Head title="Noticias"></Head>
    <v-container>
        <BreadBrums :breadbrums="breadbrums"></BreadBrums>
        <v-row class="mt-0">
            <v-col cols="12">
                <v-card flat>
                    <v-card-title class="border-b">
                        <v-row>
                            <v-col cols="12"
                                ><span class="text-body-2"
                                    >{{ form.noticias.length }} de 4
                                    noticias</span
                                ></v-col
                            >
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col
                                cols="12"
                                v-for="(item, index) in form.noticias"
                            >
                                <v-row
                                    class="border pa-2 ma-3 mb-0 mt-2 noticia"
                                >
                                    <button
                                        class="eliminar"
                                        @click="eliminarNoticia(index)"
                                    >
                                        X
                                    </button>
                                    <v-col cols="12">
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

                                    <v-col cols="12">
                                        <v-textarea
                                            :hide-details="
                                                form.errors?.descripcion
                                                    ? false
                                                    : true
                                            "
                                            :error="
                                                form.errors?.descripcion
                                                    ? true
                                                    : false
                                            "
                                            :error-messages="
                                                form.errors?.descripcion
                                                    ? form.errors?.descripcion
                                                    : ''
                                            "
                                            variant="outlined"
                                            label="Descripción"
                                            rows="1"
                                            auto-grow
                                            v-model="item.descripcion"
                                        ></v-textarea>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>

                        <v-row
                            class="border-t pt-1 mt-10"
                            v-if="props.noticias.length > 0 || form.noticias.length > 0"
                        >
                            <v-col cols="12">
                                <v-btn
                                    class="bg-principal"
                                    block
                                    prepend-icon="mdi-content-save"
                                    @click="guardarNoticias"
                                    >Guardar</v-btn
                                >
                            </v-col>
                        </v-row>

                        <v-row
                            class="border-t pt-1 mt-3"
                            v-if="form.noticias.length < 4"
                        >
                            <v-col cols="12">
                                <v-btn
                                    block
                                    prepend-icon="mdi-plus"
                                    @click="agregarNoticia"
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
.noticia {
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
</style>
