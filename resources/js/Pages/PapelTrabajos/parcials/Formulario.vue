<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { usePapelTrabajos } from "@/composables/papel_trabajos/usePapelTrabajos";
import { useTrabajoAuditorias } from "@/composables/trabajo_auditorias/useTrabajoAuditorias";
import { useMenu } from "@/composables/useMenu";
import { watch, ref, reactive, computed, onMounted } from "vue";
import MiDropZone from "@/Components/MiDropZone.vue";

const { mobile, cambiarUrl } = useMenu();
const { oPapelTrabajo, limpiarPapelTrabajo } = usePapelTrabajos();
let form = useForm(oPapelTrabajo);

const { flash, auth } = usePage().props;
const user = ref(auth.user);
const { getTrabajoAuditorias } = useTrabajoAuditorias();

const listTrabajoAuditorias = ref([]);

const tituloDialog = computed(() => {
    return oPapelTrabajo.id == 0
        ? `Agregar Trabajos de Auditoría`
        : `Editar Trabajos de Auditoría`;
});

const enviarFormulario = () => {
    let url =
        form["_method"] == "POST"
            ? route("papel_trabajos.store")
            : route("papel_trabajos.update", form.id);

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
            limpiarPapelTrabajo();
            cambiarUrl(route("papel_trabajos.index"));
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
        sin_papeles: true,
        id: id,
    });
};

const detectaArchivos = (files, nro_etapa, nro_nombre) => {
    // disabled.value = true;
    form[`papel_detalles${nro_etapa}`][nro_nombre]["papel_archivos"] = [];
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        form[`papel_detalles${nro_etapa}`][nro_nombre]["papel_archivos"].push(
            file.file
        );
    }
    // setTimeout(() => {
    //     disabled.value = false;
    // }, 500);
};

const detectaEliminados = (eliminados, nro_etapa, nro_nombre) => {
    form[`papel_detalles${nro_etapa}`][nro_nombre]["eliminados"] = [];
    console.log(eliminados);
    form[`papel_detalles${nro_etapa}`][nro_nombre]["eliminados"] = eliminados;
};

onMounted(() => {
    if (form.id && form.id != "") {
        cargarListas(form.trabajo_auditoria_id);
    } else {
        cargarListas();
    }
});
</script>

<template>
    <v-row class="mt-0">
        <v-col cols="12" class="d-flex justify-end">
            <template v-if="mobile">
                <v-btn
                    icon="mdi-arrow-left"
                    class="mr-2"
                    @click="cambiarUrl(route('papel_trabajos.index'))"
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
                    @click="cambiarUrl(route('papel_trabajos.index'))"
                >
                    Volver</v-btn
                >
                <v-btn
                    :prepend-icon="
                        oPapelTrabajo.id != 0 ? 'mdi-sync' : 'mdi-content-save'
                    "
                    class="bg-principal"
                    @click="enviarFormulario"
                >
                    <span
                        v-text="
                            oPapelTrabajo.id != 0
                                ? 'Actualizar PapelTrabajo'
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
                                        LEGAJO CORRIENTE (LC)
                                    </h4>
                                </v-col>
                                <v-col cols="12">
                                    <v-row
                                        class="contenedor_etapa"
                                        v-for="(
                                            papel_detalle, index_nombre
                                        ) in form.papel_detalles1"
                                    >
                                        <v-col cols="12">
                                            <v-card class="elevation-1" variant="outlined">
                                                <v-card-text>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            md="4"
                                                            xl="4"
                                                            class=""
                                                        >
                                                            <p
                                                                class="text-body-2 font-weight-bold mb-2 text-justify"
                                                            >
                                                                {{
                                                                    papel_detalle.nombre
                                                                }}
                                                            </p>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                >
                                                                    <v-select
                                                                        :hide-details="
                                                                            true
                                                                        "
                                                                        density="compact"
                                                                        variant="outlined"
                                                                        :items="[
                                                                            'SI',
                                                                            'NO',
                                                                        ]"
                                                                        label="Aplicabilidad"
                                                                        v-model="
                                                                            papel_detalle.aplicabilidad
                                                                        "
                                                                        required
                                                                    >
                                                                    </v-select>
                                                                </v-col>
                                                                <v-col
                                                                    cols="12"
                                                                >
                                                                    <v-select
                                                                        :hide-details="
                                                                            true
                                                                        "
                                                                        density="compact"
                                                                        variant="outlined"
                                                                        :items="[
                                                                            'NO INICIADO',
                                                                            'EN PROCESO',
                                                                            'TERMINADO AUDITOR',
                                                                            'REVISADO POR SUPERVISOR',
                                                                            'APROBADO GERENTE AUDITOR',
                                                                        ]"
                                                                        label="Estado"
                                                                        v-model="
                                                                            papel_detalle.estado
                                                                        "
                                                                        required
                                                                    >
                                                                    </v-select>
                                                                    <span
                                                                        class="text-caption font-weight-bold"
                                                                        >Actual:
                                                                        {{
                                                                            papel_detalle.estado
                                                                        }}</span
                                                                    >
                                                                </v-col>
                                                            </v-row>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            md="8"
                                                            xl="8"
                                                        >
                                                            <MiDropZone
                                                                :files="
                                                                    papel_detalle.papel_archivos
                                                                "
                                                                :nro_etapa="1"
                                                                :nro_nombre="
                                                                    index_nombre
                                                                "
                                                                @UpdateFiles="
                                                                    detectaArchivos
                                                                "
                                                                @addEliminados="
                                                                    detectaEliminados
                                                                "
                                                            ></MiDropZone>
                                                        </v-col>
                                                    </v-row>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <h4 class="text-body-2 font-weight-bold">
                                        LEGAJO RESUMEN (LR)
                                    </h4>
                                </v-col>
                                <v-col cols="12">
                                    <v-row
                                        class="contenedor_etapa"
                                        v-for="(
                                            papel_detalle, index_nombre
                                        ) in form.papel_detalles2"
                                    >
                                        <v-col cols="12">
                                            <v-card class="elevation-1" variant="outlined">
                                                <v-card-text>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            md="4"
                                                            xl="4"
                                                            class=""
                                                        >
                                                            <p
                                                                class="text-body-2 font-weight-bold mb-2 text-justify"
                                                            >
                                                                {{
                                                                    papel_detalle.nombre
                                                                }}
                                                            </p>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                >
                                                                    <v-select
                                                                        :hide-details="
                                                                            true
                                                                        "
                                                                        density="compact"
                                                                        variant="outlined"
                                                                        :items="[
                                                                            'SI',
                                                                            'NO',
                                                                        ]"
                                                                        label="Aplicabilidad"
                                                                        v-model="
                                                                            papel_detalle.aplicabilidad
                                                                        "
                                                                        required
                                                                    >
                                                                    </v-select>
                                                                </v-col>
                                                                <v-col
                                                                    cols="12"
                                                                >
                                                                    <v-select
                                                                        :hide-details="
                                                                            true
                                                                        "
                                                                        density="compact"
                                                                        variant="outlined"
                                                                        :items="[
                                                                            'NO INICIADO',
                                                                            'EN PROCESO',
                                                                            'TERMINADO AUDITOR',
                                                                            'REVISADO POR SUPERVISOR',
                                                                            'APROBADO GERENTE AUDITOR',
                                                                        ]"
                                                                        label="Estado"
                                                                        v-model="
                                                                            papel_detalle.estado
                                                                        "
                                                                        required
                                                                    >
                                                                    </v-select>
                                                                    <span
                                                                        class="text-caption font-weight-bold"
                                                                        >Actual:
                                                                        {{
                                                                            papel_detalle.estado
                                                                        }}</span
                                                                    >
                                                                </v-col>
                                                            </v-row>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            md="8"
                                                            xl="8"
                                                        >
                                                            <MiDropZone
                                                                :files="
                                                                    papel_detalle.papel_archivos
                                                                "
                                                                :nro_etapa="2"
                                                                :nro_nombre="
                                                                    index_nombre
                                                                "
                                                                @UpdateFiles="
                                                                    detectaArchivos
                                                                "
                                                                @addEliminados="
                                                                    detectaEliminados
                                                                "
                                                            ></MiDropZone>
                                                        </v-col>
                                                    </v-row>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <h4 class="text-body-2 font-weight-bold">
                                        LEGAJO PERMANENTE (LP)
                                    </h4>
                                </v-col>
                                <v-col cols="12">
                                    <v-row
                                        class="contenedor_etapa"
                                        v-for="(
                                            papel_detalle, index_nombre
                                        ) in form.papel_detalles3"
                                    >
                                        <v-col cols="12">
                                            <MiDropZone
                                                :files="
                                                    papel_detalle.papel_archivos
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
