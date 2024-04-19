<script setup>
import { ref, onMounted } from "vue";
import { useInstitucion } from "@/composables/useInstitucion";
import { menuPortalStore } from "@/stores/menuPortalStore";
import { Link, usePage } from "@inertiajs/vue3";
import { useMenu } from "@/composables/useMenu";
const { mobile } = useMenu();
const { getInstitucion, oInstitucion } = useInstitucion();
const { props } = usePage();
const store_menu_portal = menuPortalStore();
const user = props.auth.user;
const width = ref(200);
const drawer = ref(false);
const handleResize = () => {
    const x = window.innerWidth;
    const y = window.innerHeight;
    if (x <= 960) {
        drawer.value = false;
    } else {
        drawer.value = false;
    }
};

const listMenu = ref([
    {
        url: route("portal.inicio"),
        label: "Inicio",
        route: "portal.inicio",
    },
    {
        url: route("portal.comunicacion"),
        label: "Comunicación",
        route: "portal.comunicacion",
    },
    {
        url: route("portal.transparencia"),
        label: "Transparencia",
        route: "portal.transparencia",
    },
    {
        url: route("portal.contactos"),
        label: "Contactos",
        route: "portal.contactos",
    },
]);

onMounted(() => {
    if (!mobile) {
        drawer.value = false;
    }
    window.addEventListener("resize", handleResize);

    getInstitucion();
});
</script>
<template>
    <v-app id="inspire">
        <v-app-bar class="bg-principal menu_portal">
            <v-app-bar-title class="d-flex align-center">
                <img :src="oInstitucion.url_logo" style="height: 50px" v-if="!mobile" />
                {{ oInstitucion.institucion }}</v-app-bar-title
            >
            <template v-slot:prepend v-if="mobile">
                <v-app-bar-nav-icon
                    @click="drawer = !drawer"
                ></v-app-bar-nav-icon>
            </template>
            <template v-slot:append>
                <ul class="contenedor_menu" v-if="!mobile">
                    <li
                        v-for="item in listMenu"
                        :class="
                            store_menu_portal.ruta_acutal == item.route
                                ? 'active'
                                : ''
                        "
                    >
                        <Link
                            :href="item.url"
                            @click="store_menu_portal.setActual(item.route)"
                            >{{ item.label }}</Link
                        >
                    </li>
                </ul>

                <Link
                    :href="route('login')"
                    class="text-white text-decoration-none"
                    v-if="!user"
                    ><v-icon>mdi-login</v-icon> Acceder</Link
                >
                <Link
                    :href="route('inicio')"
                    class="text-white text-decoration-none"
                    v-else
                    ><v-icon>mdi-home</v-icon> Inicio</Link
                >
            </template>
        </v-app-bar>

        <v-navigation-drawer
            :permanent="!mobile"
            :temporary="!mobile"
            class="border-0 elevation-2 __sidebar bg-secundario"
            :width="width"
            v-model="drawer"
            id="sidebar"
        >
            <v-list class="mt-1 px-2">
                <template v-for="item in listMenu">
                    <Link
                        class="text-decoration-none"
                        :href="item.url"
                        @click="
                            store_menu_portal.setActual(item.route);
                            drawer = false;
                        "
                    >
                        <!-- <v-list-item prepend-icon="mdi-home-outline" link>
                            <v-list-item-title>{{
                                item.label
                            }}</v-list-item-title>
                        </v-list-item> -->
                        <v-list-item
                            link
                            :active="
                                store_menu_portal.ruta_acutal == item.route
                                    ? true
                                    : false
                            "
                        >
                            <v-list-item-title>{{
                                item.label
                            }}</v-list-item-title>
                        </v-list-item>
                    </Link>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <slot />
        </v-main>

        <v-footer
            class="d-flex flex-column pl-0 pr-0 pt-4 pb-4 bg-grey-darken-4"
        >
            <div class="px-4 py-2 text-center w-100">
                <strong>{{ oInstitucion.nombre_sistema }}</strong> —
                {{ new Date().getFullYear() }}
            </div>
        </v-footer>
    </v-app>
</template>
<style scoped>
.v-main {
    background: #e5e5e5 !important;
}

ul.contenedor_menu {
    height: 100%;
    display: flex;
    align-items: center;
    list-style: none;
}
.contenedor_menu li {
    bottom: solid 1px;
    padding: 0px;
    margin: 0px;
}

.contenedor_menu li.active a {
    background-color: rgba(255, 255, 255, 0.158);
}

.contenedor_menu li a {
    padding: 10px 15px;
    text-decoration: none;
}
</style>
