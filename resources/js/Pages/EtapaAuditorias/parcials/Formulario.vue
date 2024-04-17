<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { useEtapaAuditorias } from "@/composables/etapa_auditorias/useEtapaAuditorias";
import { useTrabajoAuditorias } from "@/composables/trabajo_auditorias/useTrabajoAuditorias";
import { useMenu } from "@/composables/useMenu";
import { watch, ref, reactive, computed, onMounted } from "vue";
import MiDropZone from "@/Components/MiDropZone.vue";

const { mobile, cambiarUrl } = useMenu();
const { oEtapaAuditoria, limpiarEtapaAuditoria } = useEtapaAuditorias();
let form = useForm(oEtapaAuditoria);

const { flash, auth } = usePage().props;
const user = ref(auth.user);
const { getTrabajoAuditorias } = useTrabajoAuditorias();

const listTrabajoAuditorias = ref([]);

const tituloDialog = computed(() => {
    return oEtapaAuditoria.id == 0
        ? `Agregar Trabajos de Auditoría`
        : `Editar Trabajos de Auditoría`;
});

const enviarFormulario = () => {
    let url =
        form["_method"] == "POST"
            ? route("etapa_auditorias.store")
            : route("etapa_auditorias.update", form.id);

    form.post(url, {
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
            limpiarEtapaAuditoria();
            cambiarUrl(route("etapa_auditorias.index"));
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

const cargarListas = async (id = "") => {
    listTrabajoAuditorias.value = await getTrabajoAuditorias({
        order: "desc",
        sin_etapa: true,
        id: id,
    });
};

const agregarNombre = (nro_etapa) => {
    form["etapa_nombres" + nro_etapa].push({
        id: 0,
        etapa_auditoria_id: "",
        nro_etapa: nro_etapa,
        nombre: "",
        etapa_archivos: [],
        eliminados: [],
    });
};

const eliminarNombre = (index, nro_etapa) => {
    if (form["etapa_nombres" + nro_etapa][index].id != 0) {
        form.eliminados_nombres.push(
            form["etapa_nombres" + nro_etapa][index].id
        );
    }
    form["etapa_nombres" + nro_etapa].splice(index, 1);
};

const detectaArchivos = (files, nro_etapa, nro_nombre) => {
    // disabled.value = true;
    form[`etapa_nombres${nro_etapa}`][nro_nombre]["etapa_archivos"] = [];
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        form[`etapa_nombres${nro_etapa}`][nro_nombre]["etapa_archivos"].push(
            file.file
        );
    }
    // setTimeout(() => {
    //     disabled.value = false;
    // }, 500);
};

const detectaEliminados = (eliminados, nro_etapa, nro_nombre) => {
    form[`etapa_nombres${nro_etapa}`][nro_nombre]["eliminados"] = [];
    console.log(eliminados);
    form[`etapa_nombres${nro_etapa}`][nro_nombre]["eliminados"] = eliminados;
};

onMounted(() => {
    if (form.id && form.id != "") {
        cargarListas(form.id);
    }
    cargarListas();
});
</script>

<template>
    <v-row class="mt-0">
        <v-col cols="12" class="d-flex justify-end">
            <template v-if="mobile">
                <v-btn
                    icon="mdi-arrow-left"
                    class="mr-2"
                    @click="cambiarUrl(route('etapa_auditorias.index'))"
                ></v-btn>
                <v-btn
                    icon="mdi-content-save"
                    class="bg-principal"
                    @click="enviarFormulario"
                ></v-btn>
            </template>
            <template v-if="!mobile">
                <v-btn
                    prepend-icon="mdi-arrow-left"
                    class="mr-2"
                    @click="cambiarUrl(route('etapa_auditorias.index'))"
                >
                    Volver</v-btn
                >
                <v-btn
                    :prepend-icon="
                        oEtapaAuditoria.id != 0
                            ? 'mdi-sync'
                            : 'mdi-content-save'
                    "
                    class="bg-principal"
                    @click="enviarFormulario"
                >
                    <span
                        v-text="
                            oEtapaAuditoria.id != 0
                                ? 'Actualizar EtapaAuditoria'
                                : 'Guardar Trabajo de Auditoría'
                        "
                    ></span
                ></v-btn>
            </template>
        </v-col>
    </v-row>
    <v-row>
        <v-col cols="12">
            <v-card>
                <v-card-title class="border-b bg-principal pa-5">
                    <v-icon
                        :icon="form.id == 0 ? 'mdi-plus' : 'mdi-pencil'"
                    ></v-icon>
                    <span class="text-h5" v-html="tituloDialog"></span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <form @submit.prevent="enviarFormulario">
                            <v-row>
                                <v-col cols="12">
                                    <v-select
                                        :hide-details="
                                            form.errors?.trabajo_auditoria_id
                                                ? false
                                                : true
                                        "
                                        :error="
                                            form.errors?.trabajo_auditoria_id
                                                ? true
                                                : false
                                        "
                                        :error-messages="
                                            form.errors?.trabajo_auditoria_id
                                                ? form.errors
                                                      ?.trabajo_auditoria_id
                                                : ''
                                        "
                                        clearable
                                        variant="outlined"
                                        label="Seleccionar Trabajo de Auditoría*"
                                        :items="listTrabajoAuditorias"
                                        item-value="id"
                                        item-title="nombre"
                                        required
                                        density="compact"
                                        v-model="form.trabajo_auditoria_id"
                                    ></v-select>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <h4 class="text-body-2 font-weight-bold">
                                        VALORACIÓN DEL RIESGO (PLANIFICACIÓN)
                                        <button
                                            type="button"
                                            class="v-btn v-btn--density-default v-btn--size-small bg-principal"
                                            @click="agregarNombre(1)"
                                        >
                                            <i class="mdi mdi-plus"></i> Agregar
                                        </button>
                                    </h4>
                                </v-col>
                                <v-col cols="12">
                                    <v-row
                                        class="contenedor_etapa"
                                        v-for="(
                                            etapa_nombre, index_nombre
                                        ) in form.etapa_nombres1"
                                    >
                                        <button
                                            type="button"
                                            class="eliminar_nombre"
                                            @click="
                                                eliminarNombre(index_nombre, 1)
                                            "
                                        >
                                            X
                                        </button>
                                        <v-col cols="12" md="4" xl="4">
                                            <v-text-field
                                                density="compact"
                                                variant="outlined"
                                                :label="`Nombre ${
                                                    index_nombre + 1
                                                }*`"
                                                v-model="etapa_nombre.nombre"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="8" xl="8">
                                            <MiDropZone
                                                :files="
                                                    etapa_nombre.etapa_archivos
                                                "
                                                :nro_etapa="1"
                                                :nro_nombre="index_nombre"
                                                @UpdateFiles="detectaArchivos"
                                                @addEliminados="
                                                    detectaEliminados
                                                "
                                            ></MiDropZone>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <h4 class="text-body-2 font-weight-bold">
                                        RESPUESTA AL RIESGO (EJECUCIÓN)
                                        <button
                                            type="button"
                                            class="v-btn v-btn--density-default v-btn--size-small bg-principal"
                                            @click="agregarNombre(2)"
                                        >
                                            <i class="mdi mdi-plus"></i> Agregar
                                        </button>
                                    </h4>
                                </v-col>
                                <v-col cols="12">
                                    <v-row
                                        class="contenedor_etapa"
                                        v-for="(
                                            etapa_nombre, index_nombre
                                        ) in form.etapa_nombres2"
                                    >
                                        <button
                                            type="button"
                                            class="eliminar_nombre"
                                            @click="
                                                eliminarNombre(index_nombre, 2)
                                            "
                                        >
                                            X
                                        </button>
                                        <v-col cols="12" md="4" xl="4">
                                            <v-text-field
                                                density="compact"
                                                variant="outlined"
                                                :label="`Nombre ${
                                                    index_nombre + 1
                                                }*`"
                                                v-model="etapa_nombre.nombre"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="8" xl="8">
                                            <MiDropZone
                                                :files="
                                                    etapa_nombre.etapa_archivos
                                                "
                                                :nro_etapa="2"
                                                :nro_nombre="index_nombre"
                                                @UpdateFiles="detectaArchivos"
                                                @addEliminados="
                                                    detectaEliminados
                                                "
                                            ></MiDropZone>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <h4 class="text-body-2 font-weight-bold">
                                        INFORME DE AUDITORÍA (DICTAMEN)
                                        <button
                                            type="button"
                                            class="v-btn v-btn--density-default v-btn--size-small bg-principal"
                                            @click="agregarNombre(3)"
                                        >
                                            <i class="mdi mdi-plus"></i> Agregar
                                        </button>
                                    </h4>
                                </v-col>
                                <v-col cols="12">
                                    <v-row
                                        class="contenedor_etapa"
                                        v-for="(
                                            etapa_nombre, index_nombre
                                        ) in form.etapa_nombres3"
                                    >
                                        <button
                                            type="button"
                                            class="eliminar_nombre"
                                            @click="
                                                eliminarNombre(index_nombre, 3)
                                            "
                                        >
                                            X
                                        </button>
                                        <v-col cols="12" md="4" xl="4">
                                            <v-text-field
                                                density="compact"
                                                variant="outlined"
                                                :label="`Nombre ${
                                                    index_nombre + 1
                                                }*`"
                                                v-model="etapa_nombre.nombre"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="8" xl="8">
                                            <MiDropZone
                                                :files="
                                                    etapa_nombre.etapa_archivos
                                                "
                                                :nro_etapa="3"
                                                :nro_nombre="index_nombre"
                                                @UpdateFiles="detectaArchivos"
                                                @addEliminados="
                                                    detectaEliminados
                                                "
                                            ></MiDropZone>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                        </form>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<style scoped>
.contenedor_etapa {
    position: relative;
}
button.eliminar_nombre {
    position: absolute;
    top: -5px;
    left: -5px;
    background-color: rgb(226, 95, 95);
    color: white;
    padding: 3px 7px;
    border-radius: 4px;
}
</style>
