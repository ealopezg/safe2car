<template>
    <jet-action-section>
        <template #title>
            Configurar Telegram
        </template>

        <template #description>
            Configura el bot de telegram para que pueda enviar notificaciones directamente a tu cuenta
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Se le abrirá un link donde podra configurar su usuario de Telegram
            </div>

            <div class="mt-5">
                <jet-button type="button" @click="setupTelegram">
                    Configurar Telegram
                </jet-button>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetButton from '@/Jetstream/Button'
    import axios from 'axios'
    export default {
        components: {
            JetActionSection,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
            JetButton
        },
        methods: {
            setupTelegram(){
                axios.post(route('user.telegram')).then((response) => {
                    window.open(response.data, '_blank')
                })
            },
        },
    }
</script>
