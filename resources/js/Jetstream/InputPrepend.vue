<template>
<div class="mt-1 flex rounded-md shadow-sm">
    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
    {{prepend}}
    </span>
    <input :type="type" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" :placeholder="placeholder" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</div>
</template>

<script>
    export default {
        props: ['modelValue','type','prepend','placeholder'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

