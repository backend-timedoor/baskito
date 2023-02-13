<template>
  <label class="custom-switch">
    <input :type="switchType" class="custom-switch-input"
      :name="name"
      :value="value"
      :disabled="disabled"
      :checked="isChecked"
      @input="updateValue">
    <span class="custom-switch-indicator"></span>
    <span class="custom-switch-description">{{ description }}</span>
  </label>
</template>

<script setup lang="ts">
  import { ref, watch, computed } from 'vue';

  type SwitchType = "multiple" | "single";
  type RadioButtonModelValueType = string | number | boolean | string[] | null;

  const types = {
    multiple: "radio",
    single: "checkbox"
  };

const getSwitchType = (type: SwitchType) => types[type];

  const props = withDefaults(
    defineProps<{
      type?: SwitchType;
      name?: string;
      description?: string;
      value?: string;
      modelValue?: RadioButtonModelValueType;
      label?: string;
      inline?: boolean;
      disabled?: boolean;
      checked?: boolean;
    }>(),
    {
      type: () => "multiple",
      value: () => "on",
      disabled: () => false,
      checked: () => false
    }
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: RadioButtonModelValueType): void;
  }>();

  const isChecked = ref(props.checked);

  watch(
    () => props.modelValue,
    (modelValue) => {
      if (modelValue) {
        updateChecked(modelValue);
      }
    }
  );

  const switchType = computed(() => getSwitchType(props.type));

  const updateChecked = (modelValue: RadioButtonModelValueType) => {
    if (props.type == 'multiple') {
      if (modelValue == props.value) {
          isChecked.value = true;
      } else {
          isChecked.value = false;
      }
    } else {
      if (Array.isArray(modelValue)) {
        if (modelValue.includes(props.value)) {
          isChecked.value = true;
        } else {
          isChecked.value = false;
        }
      } else if (typeof modelValue == "boolean") {
          isChecked.value = modelValue;
      }
    }
  };
  
  if (props.modelValue) {
    updateChecked(props.modelValue);
  }

  const updateValue = (e: Event) => {
    if (props.type == 'multiple') {
      emit('update:modelValue', props.value);
    } else {
      const checked = (e.target as HTMLInputElement).checked;
      let returnValue: RadioButtonModelValueType = checked;

      if (Array.isArray(props.modelValue)) {
        returnValue = props.modelValue;

        if (checked) {
          returnValue.push(props.value);
        } else {
          returnValue.splice(returnValue.indexOf(props.value), 1);
        }

        returnValue = JSON.parse(JSON.stringify(returnValue));
      }

      emit('update:modelValue', returnValue);
    }
  };
</script>

<style>
  .custom-switch {
      padding-left: 0;
  }
</style>
