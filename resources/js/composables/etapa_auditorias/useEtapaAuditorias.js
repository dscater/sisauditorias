import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, reactive } from "vue";
import { usePage } from "@inertiajs/vue3";

const oEtapaAuditoria = reactive({
    id: 0,
    trabajo_auditoria_id: "",
    etapa_nombres1: reactive([]),
    etapa_nombres2: reactive([]),
    etapa_nombres3: reactive([]),
    eliminados_nombres: reactive([]),
    _method: "POST",
});

export const useEtapaAuditorias = () => {
    const { flash } = usePage().props;
    const getEtapaAuditorias = async (data) => {
        try {
            const response = await axios.get(
                route("etapa_auditorias.listado"),
                {
                    headers: { Accept: "application/json" },
                    params: data,
                }
            );
            return response.data.etapa_auditorias;
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

    const getEtapaAuditoriasApi = async (data) => {
        try {
            const response = await axios.get(
                route("etapa_auditorias.paginado", data),
                {
                    headers: { Accept: "application/json" },
                }
            );
            return response.data.etapa_auditorias;
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
    const saveEtapaAuditoria = async (data) => {
        try {
            const response = await axios.post(
                route("etapa_auditorias.store", data),
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

    const deleteEtapaAuditoria = async (id) => {
        try {
            const response = await axios.delete(
                route("etapa_auditorias.destroy", id),
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

    const setEtapaAuditoria = (item = null) => {
        if (item) {
            oEtapaAuditoria.id = item.id;
            oEtapaAuditoria.trabajo_auditoria_id = item.trabajo_auditoria_id;
            oEtapaAuditoria.etapa_nombres1 = reactive([...item.etapa_nombres.filter(elem=>elem.nro_etapa == 1)]);
            oEtapaAuditoria.etapa_nombres2 = reactive([...item.etapa_nombres.filter(elem=>elem.nro_etapa == 2)]);
            oEtapaAuditoria.etapa_nombres3 = reactive([...item.etapa_nombres.filter(elem=>elem.nro_etapa == 3)]);
            oEtapaAuditoria.eliminados_nombres = reactive([]);
            oEtapaAuditoria._method = "PUT";
            return oEtapaAuditoria;
        }
        return false;
    };

    const limpiarEtapaAuditoria = () => {
        oEtapaAuditoria.id = 0;
        oEtapaAuditoria.trabajo_auditoria_id = "";
        oEtapaAuditoria.etapa_nombres1 = reactive([]);
        oEtapaAuditoria.etapa_nombres2 = reactive([]);
        oEtapaAuditoria.etapa_nombres3 = reactive([]);
        oEtapaAuditoria.eliminados_nombres = reactive([]);
        oEtapaAuditoria._method = "POST";
    };

    onMounted(() => {});

    return {
        oEtapaAuditoria,
        getEtapaAuditorias,
        getEtapaAuditoriasApi,
        saveEtapaAuditoria,
        deleteEtapaAuditoria,
        setEtapaAuditoria,
        limpiarEtapaAuditoria,
    };
};
