<script>
const breadbrums = [
    {
        title: "Inicio",
        disabled: false,
        url: route("inicio"),
        name_url: "inicio",
    },
    {
        title: "EtapaAuditorias",
        disabled: false,
        url: "",
        name_url: "",
    },
];
</script>
<script setup>
import BreadBrums from "@/Components/BreadBrums.vue";
import { useApp } from "@/composables/useApp";
import { useMenu } from "@/composables/useMenu";
import { Head, usePage } from "@inertiajs/vue3";
import { useEtapaAuditorias } from "@/composables/etapa_auditorias/useEtapaAuditorias";
import { ref, onMounted } from "vue";
const { mobile, identificaDispositivo, cambiarUrl } = useMenu();
const { setLoading } = useApp();
const { props } = usePage();
onMounted(() => {
    identificaDispositivo();
    setTimeout(() => {
        setLoading(false);
    }, 300);
});

const { getEtapaAuditoriasApi, deleteEtapaAuditoria } = useEtapaAuditorias();
const responseEtapaAuditorias = ref([]);
const listEtapaAuditorias = ref([]);
const itemsPerPage = ref(5);
const headers = ref([
    {
        title: "Id",
        align: "start",
        sortable: false,
    },
    {
        title: "Nombre Auditoría",
        align: "start",
        sortable: false,
    },
    { title: "Código de Control", align: "start", sortable: false },
    { title: "Fecha de Registro", align: "start", sortable: false },
    { title: "Acción", align: "end", sortable: false },
]);

const search = ref("");
const options = ref({
    page: 1,
    itemsPerPage: itemsPerPage,
    sortBy: "",
    sortOrder: "desc",
    search: "",
});

const loading = ref(true);
const totalItems = ref(0);
let setTimeOutLoadData = null;
const loadItems = async ({ page, itemsPerPage, sortBy }) => {
    loading.value = true;
    options.value.page = page;
    if (sortBy.length > 0) {
        options.value.sortBy = sortBy[0].key;
        options.value.sortOrder = sortBy[0].order;
    }
    options.value.search = search.value;

    clearInterval(setTimeOutLoadData);
    setTimeOutLoadData = setTimeout(async () => {
        responseEtapaAuditorias.value = await getEtapaAuditoriasApi(
            options.value
        );
        listEtapaAuditorias.value = responseEtapaAuditorias.value.data;
        totalItems.value = parseInt(responseEtapaAuditorias.value.total);
        loading.value = false;
    }, 300);
};
const recargaEtapaAuditorias = async () => {
    loading.value = true;
    listEtapaAuditorias.value = [];
    options.value.search = search.value;
    responseEtapaAuditorias.value = await getEtapaAuditoriasApi(options.value);
    listEtapaAuditorias.value = responseEtapaAuditorias.value.data;
    totalItems.value = parseInt(responseEtapaAuditorias.value.total);
    setTimeout(() => {
        loading.value = false;
    }, 300);
};

const editarEtapaAuditoria = (item) => {
    cambiarUrl(route("etapa_auditorias.edit", item.id));
};

const eliminarEtapaAuditoria = (item) => {
    Swal.fire({
        title: "¿Quierés eliminar este registro?",
        html: `<strong>${item.trabajo_auditoria.nombre}</strong>`,
        showCancelButton: true,
        confirmButtonColor: "#B61431",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        denyButtonText: `No, cancelar`,
    }).then(async (result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            let respuesta = await deleteEtapaAuditoria(item.id);
            if (respuesta && respuesta.sw) {
                recargaEtapaAuditorias();
            }
        }
    });
};
const verUbicación = async (item) => {};
</script>
<template>
    <Head title="EtapaAuditorias"></Head>
    <v-container>
        <BreadBrums :breadbrums="breadbrums"></BreadBrums>
        <v-row class="mt-0">
            <v-col cols="12" class="d-flex justify-end">
                <v-btn
                    v-if="
                        props.auth.user.permisos.includes(
                            'etapa_auditorias.create'
                        )
                    "
                    class="bg-principal"
                    prepend-icon="mdi-plus"
                    @click="cambiarUrl(route('etapa_auditorias.create'))"
                >
                    Agregar</v-btn
                >
            </v-col>
        </v-row>
        <v-row class="mt-0">
            <v-col cols="12">
                <v-card flat>
                    <v-card-title>
                        <v-row class="bg-principal d-flex align-center pa-3">
                            <v-col cols="12" sm="6" md="4">
                                EtapaAuditorias
                            </v-col>
                            <v-col cols="12" sm="6" md="4" offset-md="4">
                                <v-text-field
                                    v-model="search"
                                    label="Buscar"
                                    append-inner-icon="mdi-magnify"
                                    variant="underlined"
                                    clearable
                                    hide-details
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-data-table-server
                            v-model:items-per-page="itemsPerPage"
                            :headers="!mobile ? headers : []"
                            :class="[mobile ? 'mobile' : '']"
                            :items-length="totalItems"
                            :items="listEtapaAuditorias"
                            :loading="loading"
                            :search="search"
                            @update:options="loadItems"
                            height="auto"
                            no-data-text="No se encontrarón registros"
                            loading-text="Cargando..."
                            page-text="{0} - {1} de {2}"
                            items-per-page-text="Registros por página"
                            :items-per-page-options="[
                                { value: 10, title: '10' },
                                { value: 25, title: '25' },
                                { value: 50, title: '50' },
                                { value: 100, title: '100' },
                                {
                                    value: -1,
                                    title: 'Todos',
                                },
                            ]"
                        >
                            <template v-slot:item="{ item }">
                                <template v-if="!mobile">
                                    <tr>
                                        <td>{{ item.id }}</td>
                                        <td>
                                            {{ item.trabajo_auditoria.nombre }}
                                        </td>
                                        <td>{{ item.trabajo_auditoria.codigo }}</td>
                                        <td>{{ item.fecha_registro_t }}</td>
                                        <td class="text-right" width="5%">
                                            <v-btn
                                                v-if="
                                                    props.auth.user.permisos.includes(
                                                        'etapa_auditorias.edit'
                                                    )
                                                "
                                                color="yellow"
                                                size="small"
                                                class="pa-1 ma-1"
                                                @click="
                                                    editarEtapaAuditoria(item)
                                                "
                                                icon="mdi-pencil"
                                            ></v-btn>
                                            <v-btn
                                                v-if="
                                                    props.auth.user.permisos.includes(
                                                        'etapa_auditorias.destroy'
                                                    )
                                                "
                                                color="error"
                                                size="small"
                                                class="pa-1 ma-1"
                                                @click="
                                                    eliminarEtapaAuditoria(item)
                                                "
                                                icon="mdi-trash-can"
                                            ></v-btn>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td>
                                            <ul class="flex-content">
                                                <li
                                                    class="flex-item"
                                                    data-label="Id"
                                                >
                                                    {{ item.id }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Nombre de Auditoría"
                                                >
                                                    {{ item.nombre }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Código de Control"
                                                >
                                                    {{ item.codigo }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Fecha de Registro"
                                                >
                                                    {{ item.fecha_registro }}
                                                </li>
                                            </ul>
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                    class="text-center pa-5"
                                                >
                                                    <v-btn
                                                        v-if="
                                                            props.auth.user.permisos.includes(
                                                                'etapa_auditorias.edit'
                                                            )
                                                        "
                                                        color="yellow"
                                                        size="small"
                                                        class="pa-1 ma-1"
                                                        @click="
                                                            editarEtapaAuditoria(
                                                                item
                                                            )
                                                        "
                                                        icon="mdi-pencil"
                                                    ></v-btn>
                                                    <v-btn
                                                        v-if="
                                                            props.auth.user.permisos.includes(
                                                                'etapa_auditorias.destroy'
                                                            )
                                                        "
                                                        color="error"
                                                        size="small"
                                                        class="pa-1 ma-1"
                                                        @click="
                                                            eliminarEtapaAuditoria(
                                                                item
                                                            )
                                                        "
                                                        icon="mdi-trash-can"
                                                    ></v-btn>
                                                </v-col>
                                            </v-row>
                                        </td>
                                    </tr>
                                </template>
                            </template>
                        </v-data-table-server>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
