<script>
const breadbrums = [
    {
        title: "Inicio",
        disabled: false,
        url: route("inicio"),
        name_url: "inicio",
    },
    {
        title: "Reporte Trabajos de Auditoría",
        disabled: false,
        url: "",
        name_url: "",
    },
];
</script>

<script setup>
import BreadBrums from "@/Components/BreadBrums.vue";
import { useApp } from "@/composables/useApp";
import { computed, onMounted, ref } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import { useTrabajoAuditorias } from "@/composables/trabajo_auditorias/useTrabajoAuditorias";
import { useTipoTrabajos } from "@/composables/tipo_trabajos/useTipoTrabajos";
const { setLoading } = useApp();
const { getTrabajoAuditorias } = useTrabajoAuditorias();
const { getTipoTrabajos } = useTipoTrabajos();

const form = ref({
    tipo_trabajo_id: "todos",
    trabajo_id: "todos",
    estado: "todos",
});
const listTipoTrabajos = ref([]);
const listTrabajoAuditorias = ref([]);

const listEstados = ref([
    { value: "todos", label: "TODOS" },
    { value: "NO INICIADO", label: "NO INICIADO" },
    { value: "EN PROCESO", label: "EN PROCESO" },
    { value: "TERMINADO AUDITOR", label: "TERMINADO AUDITOR" },
    { value: "REVISADO POR SUPERVISOR", label: "REVISADO POR SUPERVISOR" },
    { value: "APROBADO GERENTE AUDITOR", label: "APROBADO GERENTE AUDITOR" },
]);

const generando = ref(false);
const txtBtn = computed(() => {
    if (generando.value) {
        return "Generando Reporte...";
    }
    return "Generar Reporte";
});

const generarReporte = () => {
    generando.value = true;
    const url = route("reportes.r_trabajo_auditorias", form.value);
    window.open(url, "_blank");
    setTimeout(() => {
        generando.value = false;
    }, 500);
};

const cargarListas = async () => {
    listTrabajoAuditorias.value = await getTrabajoAuditorias({
        order: "desc",
    });

    listTrabajoAuditorias.value.unshift({
        id: "todos",
        nombre: "TODOS",
        codigo: "",
    });

    listTipoTrabajos.value = await getTipoTrabajos({
        order: "desc",
    });

    listTipoTrabajos.value.unshift({
        id: "todos",
        nombre: "TODOS",
        codigo: "",
    });
};

onMounted(() => {
    setTimeout(() => {
        setLoading(false);
    }, 300);
    cargarListas();
});
</script>
<template>
    <Head title="Reporte Trabajos de Auditoría"></Head>
    <v-container>
        <BreadBrums :breadbrums="breadbrums"></BreadBrums>
        <v-row>
            <v-col cols="12" sm="12" md="12" xl="8" class="mx-auto">
                <v-card>
                    <v-card-item>
                        <v-container>
                            <form @submit.prevent="generarReporte">
                                <v-row>
                                    <v-col cols="12">
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
                                                    ? form.errors
                                                          ?.tipo_trabajo_id
                                                    : ''
                                            "
                                            variant="outlined"
                                            density="compact"
                                            required
                                            :items="listTipoTrabajos"
                                            item-value="id"
                                            item-title="nombre"
                                            label="Tipo de Trabajo*"
                                            v-model="form.tipo_trabajo_id"
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-select
                                            :hide-details="
                                                form.errors?.trabajo_id
                                                    ? false
                                                    : true
                                            "
                                            :error="
                                                form.errors?.trabajo_id
                                                    ? true
                                                    : false
                                            "
                                            :error-messages="
                                                form.errors?.trabajo_id
                                                    ? form.errors?.trabajo_id
                                                    : ''
                                            "
                                            variant="outlined"
                                            density="compact"
                                            required
                                            :items="listTrabajoAuditorias"
                                            item-value="id"
                                            item-title="nombre"
                                            label="Trabajo de Auditoría*"
                                            v-model="form.trabajo_id"
                                        >
                                            <template
                                                v-slot:item="{ props, item }"
                                            >
                                                <v-list-item
                                                    v-bind="props"
                                                    :subtitle="item.raw.codigo"
                                                ></v-list-item>
                                            </template>
                                            <template
                                                v-slot:selection="{ item }"
                                            >
                                                <span>{{
                                                    item.raw.nombre
                                                }}</span
                                                >&nbsp;
                                                <span
                                                    class="text-caption"
                                                    v-if="item.raw.codigo != ''"
                                                    >(
                                                    {{ item.raw.codigo }})</span
                                                >
                                            </template></v-select
                                        >
                                    </v-col>

                                    <v-col cols="12">
                                        <v-select
                                            :hide-details="
                                                form.errors?.estado
                                                    ? false
                                                    : true
                                            "
                                            :error="
                                                form.errors?.estado
                                                    ? true
                                                    : false
                                            "
                                            :error-messages="
                                                form.errors?.estado
                                                    ? form.errors?.estado
                                                    : ''
                                            "
                                            variant="outlined"
                                            density="compact"
                                            required
                                            :items="listEstados"
                                            item-value="value"
                                            item-title="label"
                                            label="Estado*"
                                            v-model="form.estado"
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-btn
                                            class="bg-principal"
                                            block
                                            @click="generarReporte"
                                            :disabled="generando"
                                            v-text="txtBtn"
                                        ></v-btn>
                                    </v-col>
                                </v-row>
                            </form>
                        </v-container>
                    </v-card-item>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
