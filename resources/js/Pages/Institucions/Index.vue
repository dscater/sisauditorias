<script>
const breadbrums = [
    {
        title: "Inicio",
        disabled: false,
        url: route("inicio"),
        name_url: "inicio",
    },
    {
        title: "Institución",
        disabled: false,
        url: route("institucions.index"),
        name_url: "institucions.index",
    },
];
</script>
<script setup>
// componentes
import BreadBrums from "@/Components/BreadBrums.vue";
import { ref, onMounted, reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useInstitucion } from "@/composables/institucion/useInstitucion";
import { useApp } from "@/composables/useApp";
const { setLoading } = useApp();
onMounted(() => {
    setTimeout(() => {
        setLoading(false);
    }, 300);
});
const props = defineProps({
    institucion: {
        type: Object,
    },
});

const institucion = ref(props.institucion);
const window = ref(0);

const cambiaVentana = (val) => {
    window.value = val;
};

institucion.value["_method"] = "put";

let form = useForm(institucion.value);

const enviaFormulario = () => {
    form.post(route("institucions.update", institucion.value.id), {
        onSuccess: () => {
            setTimeout(() => {
                obtnerInstitucion();
                cambiaVentana(0);
            }, 300);
        },
        onError: (err) => {},
    });
};

const { getInstitucion } = useInstitucion();

const obtnerInstitucion = async () => {
    try {
        institucion.value = await getInstitucion(institucion.id);
        institucion.value["_method"] = "put";
        form = useForm(institucion.value);
        limpiaRefs();
    } catch (error) {
        console.error(error);
    }
};

function cargaArchivo(e, key) {
    form[key] = null;
    form[key] = e.target.files[0];
}

const foto_director = ref(null);
const foto_subdirector = ref(null);
const logo = ref(null);
const logo2 = ref(null);
const img_organigrama = ref(null);

function limpiaRefs() {
    foto_director.value.reset();
    foto_subdirector.value.reset();
    logo.value.reset();
    logo2.value.reset();
    img_organigrama.value.reset();
}
</script>
<template>
    <v-container>
        <BreadBrums :breadbrums="breadbrums"></BreadBrums>
        <v-row class="mt-0">
            <v-col cols="12" class="d-flex justify-end">
                <v-btn
                    prepend-icon="mdi-pencil"
                    class="bg-principal"
                    v-if="window == 0"
                    @click="cambiaVentana(1)"
                >
                    Editar</v-btn
                >
                <v-btn
                    prepend-icon="mdi-close"
                    class="mr-2"
                    v-if="window == 1"
                    @click="
                        cambiaVentana(0);
                        obtnerInstitucion();
                    "
                >
                    Cancelar</v-btn
                >
                <v-btn
                    prepend-icon="mdi-content-save"
                    class="bg-principal"
                    v-if="window == 1"
                    @click="enviaFormulario"
                >
                    Guardar</v-btn
                >
            </v-col>
        </v-row>
        <v-row class="mt-0">
            <v-col cols="12">
                <v-window v-model="window">
                    <v-window-item :key="0">
                        <v-row>
                            <v-col cols="12" sm="12">
                                <v-card>
                                    <v-card-text>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                sm="4"
                                                md="2"
                                                class="text-center"
                                            >
                                                <v-img
                                                    cover
                                                    v-if="institucion.url_logo"
                                                    :src="institucion.url_logo"
                                                    class="w-75 mx-auto"
                                                ></v-img>
                                                <v-avatar
                                                    v-else
                                                    color="grey"
                                                    size="100"
                                                >
                                                    <span
                                                        class="text-h5"
                                                        v-text="
                                                            institucion.iniciales_nombre
                                                        "
                                                    ></span>
                                                </v-avatar>
                                                <v-avatar
                                                    v-else
                                                    color="grey"
                                                    size="100"
                                                >
                                                    <span
                                                        class="text-h5"
                                                        v-text="
                                                            institucion.iniciales_nombre
                                                        "
                                                    ></span>
                                                </v-avatar>
                                                <span
                                                    class="text-h6 d-block mt-3"
                                                    >{{
                                                        institucion.institucion
                                                    }}</span
                                                >

                                                {{ institucion.ciudad }}<br />
                                                {{ institucion.dir }}
                                            </v-col>
                                            <v-divider vertical></v-divider>
                                            <v-col
                                                cols="10"
                                                sm="8"
                                                md="10"
                                                class="d-flex align-center"
                                            >
                                                <v-row>
                                                    <v-col cols="12">
                                                        <h4
                                                            class="text-center text-h6"
                                                        >
                                                            INFORMACIÓN
                                                        </h4>
                                                    </v-col>
                                                    <v-col
                                                        cols="6"
                                                        md="3"
                                                        xl="3"
                                                    >
                                                        <div
                                                            class="text-caption font-weight-bold"
                                                        >
                                                            Nombre Sistema
                                                        </div>
                                                        {{
                                                            institucion.nombre_sistema
                                                        }}
                                                    </v-col>
                                                    <v-col
                                                        cols="6"
                                                        md="3"
                                                        xl="3"
                                                    >
                                                        <div
                                                            class="text-caption font-weight-bold"
                                                        >
                                                            Nit
                                                        </div>
                                                        {{ institucion.nit }}
                                                    </v-col>
                                                    <v-col
                                                        cols="6"
                                                        md="3"
                                                        xl="3"
                                                    >
                                                        <div
                                                            class="text-caption font-weight-bold"
                                                        >
                                                            Teléfonos
                                                        </div>
                                                        {{ institucion.fonos }}
                                                    </v-col>
                                                    <v-col
                                                        cols="6"
                                                        md="3"
                                                        xl="3"
                                                    >
                                                        <div
                                                            class="text-caption font-weight-bold"
                                                        >
                                                            Horarios
                                                        </div>
                                                        {{
                                                            institucion.horario
                                                        }}
                                                    </v-col>
                                                    <v-col
                                                        cols="6"
                                                        md="3"
                                                        xl="3"
                                                    >
                                                        <div
                                                            class="text-caption font-weight-bold"
                                                        >
                                                            Correo
                                                        </div>
                                                        {{ institucion.correo }}
                                                    </v-col>
                                                </v-row>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6" md="6">
                                <v-card>
                                    <v-card-title
                                        class="text-center text-body-1 font-weight-black"
                                        >ORGANIGRAMA</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <v-img
                                                cover
                                                v-if="
                                                    institucion.url_img_organigrama
                                                "
                                                :src="
                                                    institucion.url_img_organigrama
                                                "
                                            ></v-img>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >UBICACIÓN GOOGLE MAPS</v-card-title
                                    >
                                    <v-card-text>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                class="ubicacion"
                                                v-html="
                                                    institucion.ubicacion_google
                                                "
                                            ></v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <h4 class="text-h5 text-center">Institución</h4>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >MISIÓN</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="institucion.mision"
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >VISIÓN</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="institucion.vision"
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >PRINCIPIOS</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="institucion.principios"
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >VALORES</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="institucion.valores"
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <h4 class="text-h5 text-center">
                                    Transparencia
                                </h4>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >ADMINISTRACIÓN</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="
                                                    institucion.administracion
                                                "
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >CÓDIGO DE ÉTICA</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="
                                                    institucion.codigo_etica
                                                "
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >INFORMACIÓN FINANCIERA</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="
                                                    institucion.informacion_financiera
                                                "
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-card>
                                    <v-card-title
                                        class="text-h6 text-center text-body-1 font-weight-black"
                                        >VALORES</v-card-title
                                    >
                                    <v-card-text>
                                        <v-col cols="12" class="text-center">
                                            <p
                                                class="text-caption text-justify"
                                                v-text="institucion.valores"
                                            ></p>
                                        </v-col>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-window-item>
                    <v-window-item :key="1">
                        <v-row>
                            <v-col cols="12">
                                <v-card>
                                    <v-card-title
                                        >Modificar información</v-card-title
                                    >
                                    <v-card-text>
                                        <v-container>
                                            <form @submit="enviaFormulario">
                                                <v-row>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors
                                                                    ?.institucion
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.institucion
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.institucion
                                                                    ? form
                                                                          .errors
                                                                          ?.institucion
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Nombre Institución*"
                                                            v-model="
                                                                form.institucion
                                                            "
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors
                                                                    ?.nombre_sistema
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.nombre_sistema
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.nombre_sistema
                                                                    ? form
                                                                          .errors
                                                                          ?.nombre_sistema
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Nombre Sistema*"
                                                            v-model="
                                                                form.nombre_sistema
                                                            "
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors?.nit
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors?.nit
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors?.nit
                                                                    ? form
                                                                          .errors
                                                                          ?.nit
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Nit*"
                                                            v-model="form.nit"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-file-input
                                                            :hide-details="
                                                                form.errors
                                                                    ?.organigrama
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.organigrama
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.organigrama
                                                                    ? form
                                                                          .errors
                                                                          ?.organigrama
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            accept="image/png, image/jpeg, image/bmp, image/webp"
                                                            placeholder="Organigrama"
                                                            prepend-icon="mdi-camera"
                                                            label="Organigrama"
                                                            @change="
                                                                cargaArchivo(
                                                                    $event,
                                                                    'img_organigrama'
                                                                )
                                                            "
                                                            ref="img_organigrama"
                                                        ></v-file-input>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-file-input
                                                            :hide-details="
                                                                form.errors
                                                                    ?.logo
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.logo
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.logo
                                                                    ? form
                                                                          .errors
                                                                          ?.logo
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            accept="image/png, image/jpeg, image/bmp, image/webp"
                                                            placeholder="Logo"
                                                            prepend-icon="mdi-camera"
                                                            label="Logo"
                                                            @change="
                                                                cargaArchivo(
                                                                    $event,
                                                                    'logo'
                                                                )
                                                            "
                                                            ref="logo"
                                                        ></v-file-input>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col cols="12">
                                                        <h4
                                                            class="text-h5 text-center"
                                                        >
                                                            INSTITUCIÓN
                                                        </h4>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.mision
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.mision
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.mision
                                                                    ? form
                                                                          .errors
                                                                          ?.mision
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Misión"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.mision
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.vision
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.vision
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.vision
                                                                    ? form
                                                                          .errors
                                                                          ?.vision
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Visión"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.vision
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.principios
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.principios
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.principios
                                                                    ? form
                                                                          .errors
                                                                          ?.principios
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Principios"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.principios
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.valores
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.valores
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.valores
                                                                    ? form
                                                                          .errors
                                                                          ?.valores
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Valores"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.valores
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col cols="12">
                                                        <h4
                                                            class="text-h5 text-center"
                                                        >
                                                            TRANSPARENCIA
                                                        </h4>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.administracion
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.administracion
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.administracion
                                                                    ? form
                                                                          .errors
                                                                          ?.administracion
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Administración"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.administracion
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.codigo_etica
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.codigo_etica
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.codigo_etica
                                                                    ? form
                                                                          .errors
                                                                          ?.codigo_etica
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Código de ética"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.codigo_etica
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.informacion_financiera
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.informacion_financiera
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.informacion_financiera
                                                                    ? form
                                                                          .errors
                                                                          ?.informacion_financiera
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Información Financiera"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.informacion_financiera
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col cols="12">
                                                        <h4
                                                            class="text-h5 text-center"
                                                        >
                                                            CONTACTOS
                                                        </h4>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            :hide-details="
                                                                form.errors
                                                                    ?.ubicacion_google
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.ubicacion_google
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.ubicacion_google
                                                                    ? form
                                                                          .errors
                                                                          ?.ubicacion_google
                                                                    : ''
                                                            "
                                                            variant="outlined"
                                                            label="Ubicación Google Maps"
                                                            rows="1"
                                                            auto-grow
                                                            v-model="
                                                                form.ubicacion_google
                                                            "
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors?.ciudad
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors?.ciudad
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors?.ciudad
                                                                    ? form
                                                                          .errors
                                                                          ?.ciudad
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Ciudad"
                                                            v-model="form.ciudad"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors?.dir
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors?.dir
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors?.dir
                                                                    ? form
                                                                          .errors
                                                                          ?.dir
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Dirección"
                                                            v-model="form.dir"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors?.fonos
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors?.fonos
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors?.fonos
                                                                    ? form
                                                                          .errors
                                                                          ?.fonos
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Teléfonos"
                                                            v-model="form.fonos"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors?.horario
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors?.horario
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors?.horario
                                                                    ? form
                                                                          .errors
                                                                          ?.horario
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Horarios de atención"
                                                            v-model="form.horario"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="6"
                                                        xl="4"
                                                    >
                                                        <v-text-field
                                                            :hide-details="
                                                                form.errors
                                                                    ?.correo
                                                                    ? false
                                                                    : true
                                                            "
                                                            :error="
                                                                form.errors
                                                                    ?.correo
                                                                    ? true
                                                                    : false
                                                            "
                                                            :error-messages="
                                                                form.errors
                                                                    ?.correo
                                                                    ? form
                                                                          .errors
                                                                          ?.correo
                                                                    : ''
                                                            "
                                                            density="compact"
                                                            variant="outlined"
                                                            color="grey"
                                                            label="Correo electrónico"
                                                            v-model="
                                                                form.correo
                                                            "
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                </v-row>
                                            </form>
                                        </v-container>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-window-item>
                </v-window>
            </v-col>
        </v-row>
    </v-container>
</template>
