import axios from "axios";
import { onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const oTipoTrabajo = ref({
    id: 0,
    nombre: "",
    descripcion: "",
    fecha_registro: "",
    _method: "POST",
});

export const useTipoTrabajos = () => {
    const { flash } = usePage().props;
    const getTipoTrabajos = async () => {
        try {
            const response = await axios.get(route("tipo_trabajos.listado"), {
                headers: { Accept: "application/json" },
            });
            return response.data.tipo_trabajos;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };

    const getTipoTrabajosApi = async (data) => {
        try {
            const response = await axios.get(
                route("tipo_trabajos.paginado", data),
                {
                    headers: { Accept: "application/json" },
                }
            );
            return response.data.tipo_trabajos;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };
    const saveTipoTrabajo = async (data) => {
        try {
            const response = await axios.post(route("tipo_trabajos.store", data), {
                headers: { Accept: "application/json" },
            });
            Swal.fire({
                icon: "success",
                title: "Correcto",
                text: `${flash.bien ? flash.bien : "Proceso realizado"}`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            return response.data;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            console.error("Error:", err);
            throw err; // Puedes manejar el error según tus necesidades
        }
    };

    const deleteTipoTrabajo = async (id) => {
        try {
            const response = await axios.delete(
                route("tipo_trabajos.destroy", id),
                {
                    headers: { Accept: "application/json" },
                }
            );
            Swal.fire({
                icon: "success",
                title: "Correcto",
                text: `${flash.bien ? flash.bien : "Proceso realizado"}`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            return response.data;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };

    const setTipoTrabajo = (item = null) => {
        if (item) {
            oTipoTrabajo.value.id = item.id;
            oTipoTrabajo.value.nombre = item.nombre;
            oTipoTrabajo.value.descripcion = item.descripcion;
            oTipoTrabajo.value.fecha_registro = item.fecha_registro;
            oTipoTrabajo.value._method = "PUT";
            return oTipoTrabajo;
        }
        return false;
    };

    const limpiarTipoTrabajo = () => {
        oTipoTrabajo.value.id = 0;
        oTipoTrabajo.value.nombre = "";
        oTipoTrabajo.value.descripcion = "";
        oTipoTrabajo.value.fecha_registro = "";
        oTipoTrabajo.value._method = "POST";
    };

    onMounted(() => {});

    return {
        oTipoTrabajo,
        getTipoTrabajos,
        getTipoTrabajosApi,
        saveTipoTrabajo,
        deleteTipoTrabajo,
        setTipoTrabajo,
        limpiarTipoTrabajo,
    };
};
