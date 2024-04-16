import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, reactive } from "vue";
import { usePage } from "@inertiajs/vue3";

const oTrabajoAuditoria = reactive({
    id: 0,
    nombre: "",
    codigo: "",
    tipo_trabajo_id: "",
    empresa: "",
    responsable_id: "",
    objeto: "",
    objetivo: "",
    periodo: "",
    fecha_ini: "",
    duracion: "",
    fecha_entrega: "",
    personal_trabajos: reactive([]),
    eliminados: reactive([]),
    _method: "POST",
});

export const useTrabajoAuditorias = () => {
    const { flash } = usePage().props;
    const getTrabajoAuditorias = async (data) => {
        try {
            const response = await axios.get(
                route("trabajo_auditorias.listado"),
                {
                    headers: { Accept: "application/json" },
                    params: data,
                }
            );
            return response.data.trabajo_auditorias;
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

    const getTrabajoAuditoriasApi = async (data) => {
        try {
            const response = await axios.get(
                route("trabajo_auditorias.paginado", data),
                {
                    headers: { Accept: "application/json" },
                }
            );
            return response.data.trabajo_auditorias;
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
    const saveTrabajoAuditoria = async (data) => {
        try {
            const response = await axios.post(
                route("trabajo_auditorias.store", data),
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

    const deleteTrabajoAuditoria = async (id) => {
        try {
            const response = await axios.delete(
                route("trabajo_auditorias.destroy", id),
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

    const setTrabajoAuditoria = (item = null) => {
        if (item) {
            oTrabajoAuditoria.id = item.id;
            oTrabajoAuditoria.nombre = item.nombre;
            oTrabajoAuditoria.codigo = item.codigo;
            oTrabajoAuditoria.tipo_trabajo_id = item.tipo_trabajo_id;
            oTrabajoAuditoria.empresa = item.empresa;
            oTrabajoAuditoria.responsable_id = item.responsable_id;
            oTrabajoAuditoria.objeto = item.objeto;
            oTrabajoAuditoria.objetivo = item.objetivo;
            oTrabajoAuditoria.periodo = item.periodo;
            oTrabajoAuditoria.fecha_ini = item.fecha_ini;
            oTrabajoAuditoria.duracion = item.duracion;
            oTrabajoAuditoria.fecha_entrega = item.fecha_entrega;
            oTrabajoAuditoria.personal_trabajos = reactive([
                ...item.personal_trabajos,
            ]);
            oTrabajoAuditoria.eliminados = reactive([]);
            oTrabajoAuditoria._method = "PUT";
            return oTrabajoAuditoria;
        }
        return false;
    };

    const limpiarTrabajoAuditoria = () => {
        oTrabajoAuditoria.id = 0;
        oTrabajoAuditoria.nombre = "";
        oTrabajoAuditoria.codigo = "";
        oTrabajoAuditoria.tipo_trabajo_id = "";
        oTrabajoAuditoria.empresa = "";
        oTrabajoAuditoria.responsable_id = "";
        oTrabajoAuditoria.objeto = "";
        oTrabajoAuditoria.objetivo = "";
        oTrabajoAuditoria.periodo = "";
        oTrabajoAuditoria.fecha_ini = "";
        oTrabajoAuditoria.duracion = "";
        oTrabajoAuditoria.fecha_entrega = "";
        oTrabajoAuditoria.personal_trabajos = reactive([]);
        oTrabajoAuditoria.eliminados = reactive([]);
        oTrabajoAuditoria._method = "POST";
    };

    onMounted(() => {});

    return {
        oTrabajoAuditoria,
        getTrabajoAuditorias,
        getTrabajoAuditoriasApi,
        saveTrabajoAuditoria,
        deleteTrabajoAuditoria,
        setTrabajoAuditoria,
        limpiarTrabajoAuditoria,
    };
};
