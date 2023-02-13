<template>
  <div class="custom-control custom-checkbox" :class="{'custom-control-inline': inline}">
    <input type="checkbox" class="custom-control-input" 
      :id="inputId"
      :name="name" 
      :value="value"
      :disabled="disabled" 
      :checked="isChecked"
      @input="updateValue">
    <label class="custom-control-label" :for="inputId">{{ label }}</label>
  </div>
</template>

<script setup lang="ts">
  import { ref, watch } from 'vue';

  type CheckboxModelValueType = boolean | string[];

  const props = withDefaults(
    defineProps<{
      inputId: string;
      name?: string;
      value?: string;
      modelValue?: CheckboxModelValueType;
      label?: string;
      inline?: boolean;
      disabled?: boolean;
      checked?: boolean;
    }>(),
    {
      value: () => "on",
      inline: () => false,
      disabled: () => false,
      checked: () => false
    }
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: CheckboxModelValueType): void;
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

  const updateChecked = (modelValue: CheckboxModelValueType) => {
      if (Array.isArray(modelValue)) {
        if (modelValue.includes(props.value)) {
          isChecked.value = true;
        } else {
          isChecked.value = false;
        }
      } else {
          isChecked.value = modelValue;
      }
  };
  
  if (props.modelValue) {
    updateChecked(props.modelValue);
  }

  const updateValue = (e: Event) => {
      const checked = (e.target as HTMLInputElement).checked;
      let returnValue: CheckboxModelValueType = checked;

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
  };
</script>