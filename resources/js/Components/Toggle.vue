<template>
    <div
      class="flex justify-between items-center"
      @click="proxyChecked = !proxyChecked"
    >
      <h2><slot></slot></h2>
      <div
        class="
          w-16
          h-10
          flex
          items-center
          bg-gray-300
          rounded-full
          p-1
          duration-300
          ease-in-out
        "
        :class="{ 'bg-green-400': proxyChecked }"
      >
        <div
          class="
            bg-white
            w-8
            h-8
            rounded-full
            shadow-md
            transform
            duration-300
            ease-in-out
          "
          :class="{ 'translate-x-6': proxyChecked }"
        ></div>
      </div>
    </div>
</template>

<script>
export default {
  emits: ["update:checked"],

  props: {
    checked: {
      type: [Array, Boolean],
      default: false,
    },
    value: {
      default: null,
    },
  },

  computed: {
    proxyChecked: {
      get() {
        return this.checked;
      },

      set(val) {
        this.$emit("update:checked", val);
      },
    },
  },
};
</script>
