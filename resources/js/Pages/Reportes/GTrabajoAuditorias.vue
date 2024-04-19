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
import Highcharts from "highcharts";
import exporting from "highcharts/modules/exporting";
exporting(Highcharts);
Highcharts.setOptions({
    lang: {
        downloadPNG: "Descargar PNG",
        downloadJPEG: "Descargar JPEG",
        downloadPDF: "Descargar PDF",
        downloadSVG: "Descargar SVG",
        printChart: "Imprimir gráfico",
        contextButtonTitle: "Menú de exportación",
        viewFullscreen: "Pantalla completa",
        exitFullscreen: "Salir de pantalla completa",
    },
});

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

const generarReporte = async () => {
    generando.value = true;

    axios
        .get(route("reportes.r_g_trabajo_auditorias"), { params: form.value })
        .then((response) => {
            generando.value = false;
            // Create the chart
            Highcharts.chart("container", {
                chart: {
                    type: "column",
                },
                title: {
                    align: "center",
                    text: "Cantidad de Trabajos de Auditorías por Estados",
                },
                subtitle: {
                    align: "left",
                    text: "",
                },
                accessibility: {
                    announceNewData: {
                        enabled: true,
                    },
                },
                xAxis: {
                    type: "category",
                },
                yAxis: {
                    title: {
                        text: "Total",
                    },
                },
                legend: {
                    enabled: false,
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: "{point.y:.0f}",
                        },
                    },
                },

                tooltip: {
                    headerFormat:
                        '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat:
                        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>',
                },

                series: [
                    {
                        name: "Cantidad",
                        colorByPoint: true,
                        data: response.data.data,
                    },
                ],
            });
        })
        .catch((err) => {
            generando.value = false;
            console.log(err);
        });
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
            <v-col cols="12">
                <div id="container"></div>
            </v-col>
        </v-row>
    </v-container>
</template>
