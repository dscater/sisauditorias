<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { useTrabajoAuditorias } from "@/composables/trabajo_auditorias/useTrabajoAuditorias";
import { useUsuarios } from "@/composables/usuarios/useUsuarios";
import { useTipoTrabajos } from "@/composables/tipo_trabajos/useTipoTrabajos";
import { useMenu } from "@/composables/useMenu";
import { watch, ref, reactive, computed, onMounted } from "vue";

const { mobile, cambiarUrl } = useMenu();
const { oTrabajoAuditoria, limpiarTrabajoAuditoria } = useTrabajoAuditorias();
let form = useForm(oTrabajoAuditoria);

const { flash, auth } = usePage().props;
const user = ref(auth.user);
const { getUsuariosByTipo } = useUsuarios();
const { getTipoTrabajos } = useTipoTrabajos();

const listUsuariosGerente = ref([]);
const listUsuariosAuditor = ref([]);
const listTipoTrabajos = ref([]);

const tituloDialog = computed(() => {
    return oTrabajoAuditoria.id == 0
        ? `Agregar Trabajos de Auditoría`
        : `Editar Trabajos de Auditoría`;
});

const enviarFormulario = () => {
    let url =
        form["_method"] == "POST"
            ? route("trabajo_auditorias.store")
            : route("trabajo_auditorias.update", form.id);

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
            limpiarTrabajoAuditoria();
            cambiarUrl(route("trabajo_auditorias.index"));
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

const cargarListas = async () => {
    listUsuariosGerente.value = await getUsuariosByTipo({
        order: "desc",
        tipo: "GERENTE AUDITOR",
    });
    listUsuariosAuditor.value = await getUsuariosByTipo({
        order: "desc",
        tipo: "AUDITOR",
    });
    listTipoTrabajos.value = await getTipoTrabajos({
        order: "desc",
    });
};

const agregarPersonalForm = () => {
    form.personal_trabajos.push({
        id: 0,
        trabajo_auditoria_id: 0,
        personal_id: null,
        horas: 0,
    });
};

const eliminarPersonalForm = (index) => {
    if (form.personal_trabajos[index].id != 0) {
        form.eliminados.push(form.personal_trabajos[index].id);
    }

    form.personal_trabajos.splice(index, 1);
};

onMounted(() => {
    if (form.id && form.id != "") {
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
                    @click="cambiarUrl(route('trabajo_auditorias.index'))"
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
                    @click="cambiarUrl(route('trabajo_auditorias.index'))"
                >
                    Volver</v-btn
                >
                <v-btn
                    :prepend-icon="
                        oTrabajoAuditoria.id != 0
                            ? 'mdi-sync'
                            : 'mdi-content-save'
                    "
                    class="bg-principal"
                    @click="enviarFormulario"
                >
                    <span
                        v-text="
                            oTrabajoAuditoria.id != 0
                                ? 'Actualizar TrabajoAuditoria'
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
                                <v-col cols="12" md="4" xl="3">
                                    <v-textarea
                                        :hide-details="
                                            form.errors?.nombre ? false : true
                                        "
                                        :error="
                                            form.errors?.nombre ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.nombre
                                                ? form.errors?.nombre
                                                : ''
                                        "
                                        variant="outlined"
                                        label="Nombre del Auditoría*"
                                        rows="1"
                                        auto-grow
                                        density="compact"
                                        v-model="form.nombre"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-textarea
                                        :hide-details="
                                            form.errors?.codigo ? false : true
                                        "
                                        :error="
                                            form.errors?.codigo ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.codigo
                                                ? form.errors?.codigo
                                                : ''
                                        "
                                        variant="outlined"
                                        label="Código de Control*"
                                        rows="1"
                                        auto-grow
                                        density="compact"
                                        v-model="form.codigo"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-select
                                        :hide-details="
                                            form.errors?.tipo_trabajo_id
                                                ? false
                                                : true
                                        "
                                        :error="
                                            form.errors?.tipo_trabajo_id
                                                ? true
                                                : false
                                        "
                                        :error-messages="
                                            form.errors?.tipo_trabajo_id
                                                ? form.errors?.tipo_trabajo_id
                                                : ''
                                        "
                                        clearable
                                        variant="outlined"
                                        label="Seleccionar Tipo de Trabajo*"
                                        :items="listTipoTrabajos"
                                        item-value="id"
                                        item-title="nombre"
                                        required
                                        density="compact"
                                        v-model="form.tipo_trabajo_id"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-textarea
                                        :hide-details="
                                            form.errors?.empresa ? false : true
                                        "
                                        :error="
                                            form.errors?.empresa ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.empresa
                                                ? form.errors?.empresa
                                                : ''
                                        "
                                        variant="outlined"
                                        label="Empresa*"
                                        rows="1"
                                        auto-grow
                                        density="compact"
                                        v-model="form.empresa"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-select
                                        :hide-details="
                                            form.errors?.responsable_id
                                                ? false
                                                : true
                                        "
                                        :error="
                                            form.errors?.responsable_id
                                                ? true
                                                : false
                                        "
                                        :error-messages="
                                            form.errors?.responsable_id
                                                ? form.errors?.responsable_id
                                                : ''
                                        "
                                        clearable
                                        variant="outlined"
                                        label="Seleccionar Gerente Responsable de Auditoría*"
                                        :items="listUsuariosGerente"
                                        item-value="id"
                                        item-title="full_name"
                                        required
                                        density="compact"
                                        v-model="form.responsable_id"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-textarea
                                        :hide-details="
                                            form.errors?.objeto ? false : true
                                        "
                                        :error="
                                            form.errors?.objeto ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.objeto
                                                ? form.errors?.objeto
                                                : ''
                                        "
                                        variant="outlined"
                                        label="Objeto*"
                                        rows="1"
                                        auto-grow
                                        density="compact"
                                        v-model="form.objeto"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-textarea
                                        :hide-details="
                                            form.errors?.objetivo ? false : true
                                        "
                                        :error="
                                            form.errors?.objetivo ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.objetivo
                                                ? form.errors?.objetivo
                                                : ''
                                        "
                                        variant="outlined"
                                        label="Objetivo*"
                                        rows="1"
                                        auto-grow
                                        density="compact"
                                        v-model="form.objetivo"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-textarea
                                        :hide-details="
                                            form.errors?.periodo ? false : true
                                        "
                                        :error="
                                            form.errors?.periodo ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.periodo
                                                ? form.errors?.periodo
                                                : ''
                                        "
                                        variant="outlined"
                                        label="Periodo que abarca el Trabajo*"
                                        rows="1"
                                        auto-grow
                                        density="compact"
                                        v-model="form.periodo"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-text-field
                                        :hide-details="
                                            form.errors?.fecha_ini
                                                ? false
                                                : true
                                        "
                                        :error="
                                            form.errors?.fecha_ini
                                                ? true
                                                : false
                                        "
                                        :error-messages="
                                            form.errors?.fecha_ini
                                                ? form.errors?.fecha_ini
                                                : ''
                                        "
                                        type="date"
                                        variant="outlined"
                                        label="Fecha de Inicio*"
                                        density="compact"
                                        v-model="form.fecha_ini"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-select
                                        :hide-details="
                                            form.errors?.duracion ? false : true
                                        "
                                        :error="
                                            form.errors?.duracion ? true : false
                                        "
                                        :error-messages="
                                            form.errors?.duracion
                                                ? form.errors?.duracion
                                                : ''
                                        "
                                        density="compact"
                                        variant="outlined"
                                        clearable
                                        :items="['HÁBILES', 'CALENDARIO']"
                                        label="Duración*"
                                        v-model="form.duracion"
                                        required
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="4" xl="3">
                                    <v-text-field
                                        :hide-details="
                                            form.errors?.fecha_entrega
                                                ? false
                                                : true
                                        "
                                        :error="
                                            form.errors?.fecha_entrega
                                                ? true
                                                : false
                                        "
                                        :error-messages="
                                            form.errors?.fecha_entrega
                                                ? form.errors?.fecha_entrega
                                                : ''
                                        "
                                        type="date"
                                        variant="outlined"
                                        label="Fecha de Entrega de Informe*"
                                        density="compact"
                                        v-model="form.fecha_entrega"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <h4
                                        class="text-center text-h5 font-weight-bold"
                                    >
                                        Asignar Personal
                                    </h4>
                                </v-col>
                                <v-col cols="12" md="4" xl="3" class="mx-auto">
                                    <v-btn
                                        block
                                        prepend-icon="mdi-plus"
                                        @click="agregarPersonalForm"
                                        >Agregar</v-btn
                                    >
                                </v-col>
                                <v-col
                                    cols="12"
                                    v-for="(
                                        item, index
                                    ) in form.personal_trabajos"
                                >
                                    <v-row class="contenedor_personal">
                                        <button
                                            type="button"
                                            class="eliminar"
                                            @click="eliminarPersonalForm(index)"
                                        >
                                            X
                                        </button>
                                        <v-col cols="12" md="6" xl="6">
                                            <v-select
                                                :hide-details="true"
                                                clearable
                                                variant="outlined"
                                                label="Seleccionar Personal*"
                                                :items="listUsuariosAuditor"
                                                item-value="id"
                                                item-title="full_name"
                                                required
                                                density="compact"
                                                v-model="item.personal_id"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" md="6" xl="6">
                                            <v-text-field
                                                :hide-details="true"
                                                type="number"
                                                variant="outlined"
                                                label="Horas Presupuesto*"
                                                density="compact"
                                                v-model="item.horas"
                                            ></v-text-field>
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
.contenedor_personal {
    position: relative;
}
button.eliminar {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: rgb(226, 95, 95);
    color: white;
    padding: 3px 7px;
    border-radius: 4px;
}
</style>
