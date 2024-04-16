<script>
const breadbrums = [
    {
        title: "Inicio",
        disabled: false,
        url: route("inicio"),
        name_url: "inicio",
    },
    {
        title: "TrabajoAuditorias",
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
import { useTrabajoAuditorias } from "@/composables/trabajo_auditorias/useTrabajoAuditorias";
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

const { getTrabajoAuditoriasApi, deleteTrabajoAuditoria } =
    useTrabajoAuditorias();
const responseTrabajoAuditorias = ref([]);
const listTrabajoAuditorias = ref([]);
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
    { title: "Tipo de Trabajo de Auditoría", align: "start", sortable: false },
    { title: "Empresa", align: "start", sortable: false },
    {
        title: "Gerente Responsable de Auditoría",
        align: "start",
        sortable: false,
    },
    { title: "Objeto", align: "start", sortable: false },
    { title: "Objetivo", align: "start", sortable: false },
    { title: "Más", align: "start", sortable: false },
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
        responseTrabajoAuditorias.value = await getTrabajoAuditoriasApi(
            options.value
        );
        listTrabajoAuditorias.value = responseTrabajoAuditorias.value.data;
        totalItems.value = parseInt(responseTrabajoAuditorias.value.total);
        loading.value = false;
    }, 300);
};
const recargaTrabajoAuditorias = async () => {
    loading.value = true;
    listTrabajoAuditorias.value = [];
    options.value.search = search.value;
    responseTrabajoAuditorias.value = await getTrabajoAuditoriasApi(
        options.value
    );
    listTrabajoAuditorias.value = responseTrabajoAuditorias.value.data;
    totalItems.value = parseInt(responseTrabajoAuditorias.value.total);
    setTimeout(() => {
        loading.value = false;
    }, 300);
};

const editarTrabajoAuditoria = (item) => {
    cambiarUrl(route("trabajo_auditorias.edit", item.id));
};

const eliminarTrabajoAuditoria = (item) => {
    Swal.fire({
        title: "¿Quierés eliminar este registro?",
        html: `<strong>${item.nombre}</strong>`,
        showCancelButton: true,
        confirmButtonColor: "#B61431",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        denyButtonText: `No, cancelar`,
    }).then(async (result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            let respuesta = await deleteTrabajoAuditoria(item.id);
            if (respuesta && respuesta.sw) {
                recargaTrabajoAuditorias();
            }
        }
    });
};
const verUbicación = async (item) => {};
</script>
<template>
    <Head title="TrabajoAuditorias"></Head>
    <v-container>
        <BreadBrums :breadbrums="breadbrums"></BreadBrums>
        <v-row class="mt-0">
            <v-col cols="12" class="d-flex justify-end">
                <v-btn
                    v-if="
                        props.auth.user.permisos.includes(
                            'trabajo_auditorias.create'
                        )
                    "
                    class="bg-principal"
                    prepend-icon="mdi-plus"
                    @click="cambiarUrl(route('trabajo_auditorias.create'))"
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
                                TrabajoAuditorias
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
                            :items="listTrabajoAuditorias"
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
                                            {{ item.nombre }}
                                        </td>
                                        <td>{{ item.codigo }}</td>
                                        <td>{{ item.tipo_trabajo.nombre }}</td>
                                        <td>{{ item.empresa }}</td>
                                        <td>
                                            {{ item.responsable.full_name }}
                                        </td>
                                        <td>{{ item.objeto }}</td>
                                        <td>{{ item.objetivo }}</td>
                                        <td>
                                            <v-btn
                                                :icon="
                                                    item.mas
                                                        ? 'mdi-chevron-down'
                                                        : 'mdi-chevron-left'
                                                "
                                                @click="item.mas = !item.mas"
                                            ></v-btn>
                                        </td>
                                        <td class="text-right" width="5%">
                                            <v-btn
                                                v-if="
                                                    props.auth.user.permisos.includes(
                                                        'trabajo_auditorias.edit'
                                                    )
                                                "
                                                color="yellow"
                                                size="small"
                                                class="pa-1 ma-1"
                                                @click="
                                                    editarTrabajoAuditoria(item)
                                                "
                                                icon="mdi-pencil"
                                            ></v-btn>
                                            <v-btn
                                                v-if="
                                                    props.auth.user.permisos.includes(
                                                        'trabajo_auditorias.destroy'
                                                    )
                                                "
                                                color="error"
                                                size="small"
                                                class="pa-1 ma-1"
                                                @click="
                                                    eliminarTrabajoAuditoria(
                                                        item
                                                    )
                                                "
                                                icon="mdi-trash-can"
                                            ></v-btn>
                                        </td>
                                    </tr>
                                    <tr v-if="item.mas">
                                        <td
                                            :colspan="headers.length"
                                            class="py-5"
                                        >
                                            <v-row>
                                                <v-col
                                                    cols="3"
                                                    class="text-center"
                                                >
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            class="pb-0 text-caption font-weight-black"
                                                            >Periodo que Abarca
                                                            el Trabajo</v-col
                                                        >
                                                        <v-col cols="12">{{
                                                            item.periodo
                                                        }}</v-col>
                                                    </v-row>
                                                </v-col>
                                                <v-col
                                                    cols="3"
                                                    class="text-center"
                                                >
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            class="pb-0 text-caption font-weight-black"
                                                            >Fecha de
                                                            Inicio</v-col
                                                        >
                                                        <v-col cols="12">{{
                                                            item.fecha_ini_t
                                                        }}</v-col>
                                                    </v-row>
                                                </v-col>
                                                <v-col
                                                    cols="3"
                                                    class="text-center"
                                                >
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            class="pb-0 text-caption font-weight-black"
                                                            >Días de
                                                            duración</v-col
                                                        >
                                                        <v-col cols="12">{{
                                                            item.duracion
                                                        }}</v-col>
                                                    </v-row>
                                                </v-col>
                                                <v-col
                                                    cols="3"
                                                    class="text-center"
                                                >
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            class="pb-0 text-caption font-weight-black"
                                                            >Fecha de Entrega de
                                                            Informe</v-col
                                                        >
                                                        <v-col cols="12">{{
                                                            item.fecha_entrega_t
                                                        }}</v-col>
                                                    </v-row>
                                                </v-col>
                                                <v-col
                                                    cols="3"
                                                    class="text-center"
                                                >
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            class="pb-0 text-caption font-weight-black"
                                                            >Personal
                                                            Asignado</v-col
                                                        >
                                                        <v-col cols="12">
                                                            <ol class="pl-4">
                                                                <li
                                                                    class="text-left"
                                                                    v-for="personal in item.personal_trabajos"
                                                                >
                                                                    {{
                                                                        personal
                                                                            .personal
                                                                            .full_name
                                                                    }}
                                                                    ({{
                                                                        personal.horas
                                                                    }}
                                                                    hrs.)
                                                                </li>
                                                            </ol>
                                                        </v-col>
                                                    </v-row>
                                                </v-col>
                                                <v-col
                                                    cols="3"
                                                    class="text-center"
                                                >
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            class="pb-0 text-caption font-weight-black"
                                                            >Fecha de
                                                            Registro</v-col
                                                        >
                                                        <v-col cols="12">{{
                                                            item.fecha_registro_t
                                                        }}</v-col>
                                                    </v-row>
                                                </v-col>
                                            </v-row>
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
                                                    data-label="Tipo de Trabajo de Auditoría"
                                                >
                                                    {{
                                                        item.tipo_trabajo.nombre
                                                    }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Empresa"
                                                >
                                                    {{ item.empresa }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Gerente Responsable de Auditoría"
                                                >
                                                    {{
                                                        item.responsable
                                                            .full_name
                                                    }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Objeto"
                                                >
                                                    {{ item.objeto }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Objetivo"
                                                >
                                                    {{ item.objetivo }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Periodo que abarca el Trabajo"
                                                >
                                                    {{ item.periodo }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Fecha de Inicio"
                                                >
                                                    {{ item.fecha_ini_t }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Días de Duración"
                                                >
                                                    {{ item.duracion }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Fecha de Entrega de Informe"
                                                >
                                                    {{ item.fecha_entrega_t }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Fecha de Registro"
                                                >
                                                    {{ item.fecha_registro }}
                                                </li>
                                                <li
                                                    class="flex-item"
                                                    data-label="Personal Asignado"
                                                >
                                                    <ol class="pl-4">
                                                        <li
                                                            v-for="personal in item.personal_trabajos"
                                                        >
                                                            {{
                                                                personal
                                                                    .personal
                                                                    .full_name
                                                            }}
                                                            ({{
                                                                personal.horas
                                                            }}
                                                            hrs.)
                                                        </li>
                                                    </ol>
                                                </li>
                                            </ul>
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                    class="text-center pa-5"
                                                >
                                                    <!-- <v-btn
                                                        color="primary"
                                                        size="small"
                                                        class="pa-1 ma-1"
                                                        @click="
                                                            verUbicación(item)
                                                        "
                                                        icon="mdi-map-marker"
                                                    ></v-btn> -->
                                                    <v-btn
                                                        v-if="
                                                            props.auth.user.permisos.includes(
                                                                'trabajo_auditorias.edit'
                                                            )
                                                        "
                                                        color="yellow"
                                                        size="small"
                                                        class="pa-1 ma-1"
                                                        @click="
                                                            editarTrabajoAuditoria(
                                                                item
                                                            )
                                                        "
                                                        icon="mdi-pencil"
                                                    ></v-btn>
                                                    <v-btn
                                                        v-if="
                                                            props.auth.user.permisos.includes(
                                                                'trabajo_auditorias.destroy'
                                                            )
                                                        "
                                                        color="error"
                                                        size="small"
                                                        class="pa-1 ma-1"
                                                        @click="
                                                            eliminarTrabajoAuditoria(
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
