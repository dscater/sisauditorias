<script setup>
import { useMenu } from "@/composables/useMenu";
import { onMounted, ref } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { useUser } from "@/composables/useUser";
const { oUser } = useUser();

// data
const {
    mobile,
    drawer,
    rail,
    width,
    menu_open,
    setMenuOpen,
    cambiarUrl,
    toggleDrawer,
} = useMenu();

const user_logeado = ref({
    permisos: [],
});

const submenus = {
    "reportes.usuarios": "Reportes",
    "reportes.trabajo_auditorias": "Reportes",
    "reportes.g_trabajo_auditorias": "Reportes",
    "institucions.index": "Institucion",
    "publicacions.index": "Institucion",
    "noticias.index": "Institucion",
    "multimedias.index": "Institucion",
};

const route_current = ref("");

router.on("navigate", (event) => {
    route_current.value = route().current();
    if (mobile.value) {
        toggleDrawer(false);
    }
});

const { props: props_page } = usePage();

onMounted(() => {
    let route_actual = route().current();
    // buscar en submenus y abrirlo si uno de sus elementos esta activo
    setMenuOpen([]);
    if (submenus[route_actual]) {
        setMenuOpen([submenus[route_actual]]);
    }

    if (props_page.auth) {
        user_logeado.value = props_page.auth?.user;
    }

    setTimeout(() => {
        scrollActive();
    }, 300);
});

const scrollActive = () => {
    let sidebar = document.querySelector("#sidebar");
    let menu = null;
    let activeChild = null;
    if (sidebar) {
        menu = sidebar.querySelector(".v-navigation-drawer__content");
        activeChild = sidebar.querySelector(".active");
    }
    // Verifica si se encontró un hijo activo
    if (activeChild) {
        let offsetTop = activeChild.offsetTop - sidebar.offsetTop;
        setTimeout(() => {
            menu.scrollTo({
                top: offsetTop,
                behavior: "smooth", // desplazamiento suave
            });
        }, 500);
    }
};
</script>
<template>
    <v-navigation-drawer
        :permanent="!mobile"
        :temporary="mobile"
        v-model="drawer"
        class="border-0 elevation-2 __sidebar bg-secundario"
        :width="width"
        id="sidebar"
    >
        <v-sheet>
            <div
                class="w-100 d-flex flex-column align-center elevation-1 bg-secundario-hover pa-2 __info_usuario"
            >
                <v-avatar
                    class="mb-1"
                    color="grey-darken-3"
                    :size="`${!rail ? '64' : '32'}`"
                >
                    <v-img
                        cover
                        v-if="oUser.url_foto"
                        :src="oUser.url_foto"
                    ></v-img>
                    <span v-else class="text-h5">
                        {{ oUser.iniciales_nombre }}
                    </span>
                </v-avatar>
                <div v-show="!rail" class="text-caption font-weight-bold">
                    {{ oUser.tipo }}
                </div>
                <div v-show="!rail" class="text-body">
                    {{ oUser.full_name }}
                </div>
            </div>
        </v-sheet>

        <v-list class="mt-1 px-2" v-model:opened="menu_open">
            <v-list-item class="text-caption">
                <span v-if="rail && !mobile" class="text-center d-block"
                    ><v-icon>mdi-dots-horizontal</v-icon></span
                >
                <span v-else>INICIO</span></v-list-item
            >
            <v-list-item
                prepend-icon="mdi-home-outline"
                :class="[route_current == 'inicio' ? 'active' : '']"
                @click="cambiarUrl(route('inicio'))"
                link
            >
                <v-list-item-title>Inicio</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Inicio</v-tooltip
                >
            </v-list-item>
            <v-list-item
                class="text-caption"
                v-if="
                    oUser.permisos.includes('usuarios.index') ||
                    oUser.permisos.includes('tipo_trabajos.index') ||
                    oUser.permisos.includes('trabajo_auditorias.index') ||
                    oUser.permisos.includes('etapa_auditorias.index') ||
                    oUser.permisos.includes('papel_trabajos.index') ||
                    oUser.permisos.includes('institucions.index')
                "
            >
                <span v-if="rail && !mobile" class="text-center d-block"
                    ><v-icon>mdi-dots-horizontal</v-icon></span
                >
                <span v-else>ADMINISTRACIÓN</span></v-list-item
            >
            <v-list-item
                :class="[
                    route_current == 'tipo_trabajos.index' ? 'active' : '',
                ]"
                v-if="oUser.permisos.includes('tipo_trabajos.index')"
                prepend-icon="mdi-clipboard-list"
                @click="cambiarUrl(route('tipo_trabajos.index'))"
                link
            >
                <v-list-item-title
                    >Tipos de Trabajos de Auditoría</v-list-item-title
                >
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Tipos de Trabajos de Auditoría</v-tooltip
                >
            </v-list-item>
            <v-list-item
                :class="[
                    route_current == 'trabajo_auditorias.index' ? 'active' : '',
                ]"
                v-if="oUser.permisos.includes('trabajo_auditorias.index')"
                prepend-icon="mdi-folder-multiple"
                @click="cambiarUrl(route('trabajo_auditorias.index'))"
                link
            >
                <v-list-item-title>Trabajos de Auditoría</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Trabajos de Auditoría</v-tooltip
                >
            </v-list-item>
            <v-list-item
                :class="[
                    route_current == 'etapa_auditorias.index' ? 'active' : '',
                ]"
                v-if="oUser.permisos.includes('etapa_auditorias.index')"
                prepend-icon="mdi-view-list"
                @click="cambiarUrl(route('etapa_auditorias.index'))"
                link
            >
                <v-list-item-title>Etapas de la Auditoría</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Etapas de la Auditoría</v-tooltip
                >
            </v-list-item>
            <v-list-item
                :class="[
                    route_current == 'papel_trabajos.index' ? 'active' : '',
                ]"
                v-if="oUser.permisos.includes('papel_trabajos.index')"
                prepend-icon="mdi-folder-file"
                @click="cambiarUrl(route('papel_trabajos.index'))"
                link
            >
                <v-list-item-title>Papeles de trabajo</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Papeles de trabajo</v-tooltip
                >
            </v-list-item>
            <v-list-item
                :class="[route_current == 'usuarios.index' ? 'active' : '']"
                v-if="oUser.permisos.includes('usuarios.index')"
                prepend-icon="mdi-account-group"
                @click="cambiarUrl(route('usuarios.index'))"
                link
            >
                <v-list-item-title>Usuarios</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Usuarios</v-tooltip
                >
            </v-list-item>

            <v-list-item
                class="text-caption"
                v-if="
                    oUser.permisos.includes('reportes.usuarios') ||
                    oUser.permisos.includes('reportes.trabajo_auditorias')||
                    oUser.permisos.includes('reportes.g_trabajo_auditorias')
                "
                ><span v-if="rail && !mobile" class="text-center d-block"
                    ><v-icon>mdi-dots-horizontal</v-icon></span
                >
                <span v-else>REPORTES</span></v-list-item
            >
            <!-- SUBGROUP -->
            <v-list-group
                value="Reportes"
                v-if="
                    oUser.permisos.includes('reportes.usuarios') ||
                    oUser.permisos.includes('reportes.trabajo_auditorias') ||
                    oUser.permisos.includes('reportes.g_trabajo_auditorias')
                "
            >
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        prepend-icon="mdi-file-document-multiple"
                        title="Reportes"
                        :class="[
                            route_current == 'reportes.usuarios' ||
                            route_current ==
                                'reportes.solicitud_mantenimiento' ||
                            route_current == 'reportes.trabajo_auditorias' ||
                            route_current == 'reportes.g_trabajo_auditorias'
                                ? 'active'
                                : '',
                        ]"
                    >
                        <v-tooltip
                            v-if="rail && !mobile"
                            color="white"
                            activator="parent"
                            location="end"
                            >Reportes</v-tooltip
                        ></v-list-item
                    >
                </template>
                <v-list-item
                    v-if="oUser.permisos.includes('reportes.usuarios')"
                    prepend-icon="mdi-chevron-right"
                    title="Usuarios"
                    :class="[
                        route_current == 'reportes.usuarios' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('reportes.usuarios'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Usuarios</v-tooltip
                    ></v-list-item
                >
                <v-list-item
                    v-if="oUser.permisos.includes('reportes.trabajo_auditorias')"
                    prepend-icon="mdi-chevron-right"
                    title="Trabajos de Auditoría"
                    :class="[
                        route_current == 'reportes.trabajo_auditorias' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('reportes.trabajo_auditorias'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Trabajos de Auditoría</v-tooltip
                    ></v-list-item
                >
                <v-list-item
                    v-if="oUser.permisos.includes('reportes.g_trabajo_auditorias')"
                    prepend-icon="mdi-chevron-right"
                    title="Estados y Cantidad de Trabajos de Auditoría"
                    :class="[
                        route_current == 'reportes.g_trabajo_auditorias' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('reportes.g_trabajo_auditorias'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Estados y Cantidad de Trabajos de Auditoría</v-tooltip
                    ></v-list-item
                >
            </v-list-group>
            <!-- ################################################ -->
            <v-list-item class="text-caption"
                ><span v-if="rail && !mobile" class="text-center d-block"
                    ><v-icon>mdi-dots-horizontal</v-icon></span
                >
                <span v-else>OTROS</span></v-list-item
            >

            <!-- SUBGROUP -->
            <v-list-group
                value="Institucion"
                v-if="
                    oUser.permisos.includes('institucions.index') ||
                    oUser.permisos.includes('publicacions.index') ||
                    oUser.permisos.includes('noticias.index') ||
                    oUser.permisos.includes('multimedias.index')
                "
            >
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        prepend-icon="mdi-list-box-outline"
                        title="Institución"
                        :class="[
                            route_current == 'institucions.index' ||
                            route_current == 'publicacions.index' ||
                            route_current == 'noticias.index' ||
                            route_current == 'multimedias.index'
                                ? 'active'
                                : '',
                        ]"
                    >
                        <v-tooltip
                            v-if="rail && !mobile"
                            color="white"
                            activator="parent"
                            location="end"
                            >Institución</v-tooltip
                        ></v-list-item
                    >
                </template>
                <v-list-item
                    v-if="oUser.permisos.includes('institucions.index')"
                    prepend-icon="mdi-chevron-right"
                    title="Información"
                    :class="[
                        route_current == 'institucions.index' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('institucions.index'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Información</v-tooltip
                    ></v-list-item
                >
                <v-list-item
                    v-if="oUser.permisos.includes('publicacions.index')"
                    prepend-icon="mdi-chevron-right"
                    title="Publicaciones"
                    :class="[
                        route_current == 'publicacions.index' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('publicacions.index'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Publicaciones</v-tooltip
                    ></v-list-item
                >
                <v-list-item
                    v-if="oUser.permisos.includes('noticias.index')"
                    prepend-icon="mdi-chevron-right"
                    title="Noticias"
                    :class="[
                        route_current == 'noticias.index' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('noticias.index'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Noticias</v-tooltip
                    ></v-list-item
                >
                <v-list-item
                    v-if="oUser.permisos.includes('multimedias.index')"
                    prepend-icon="mdi-chevron-right"
                    title="Multimedia"
                    :class="[
                        route_current == 'multimedias.index' ? 'active' : '',
                    ]"
                    @click="cambiarUrl(route('multimedias.index'))"
                    link
                >
                    <v-tooltip
                        v-if="rail && !mobile"
                        color="white"
                        activator="parent"
                        location="end"
                        >Multimedia</v-tooltip
                    ></v-list-item
                >
            </v-list-group>
            <v-list-item
                prepend-icon="mdi-account-circle"
                :class="[route_current == 'profile.edit' ? 'active' : '']"
                @click="cambiarUrl(route('profile.edit'))"
                link
            >
                <v-list-item-title>Perfil</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Perfil</v-tooltip
                >
            </v-list-item>
            <v-list-item
                prepend-icon="mdi-logout"
                @click="cambiarUrl(route('logout'), 'post')"
                link
            >
                <v-list-item-title>Salir</v-list-item-title>
                <v-tooltip
                    v-if="rail && !mobile"
                    color="white"
                    activator="parent"
                    location="end"
                    >Salir</v-tooltip
                >
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<style scoped></style>
