<template>
    <div v-if="validationErrors">
        <ul class="alert alert-danger">
            <li v-for="(value, key, index) in validationErrors" :key="index">{{ value }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'ValidationErrors',
    props: ['errors', 'errorKey'],
    computed: {
        validationErrors(){
            let errors = this.errors
            if (this.errorKey && typeof errors === 'object') {
                if (Object.prototype.hasOwnProperty.call(errors,this.errorKey)) {
                    errors = errors[this.errorKey]
                } else {
                    errors = null
                }
            } else {
                errors = Object.values(this.errors).flat()
            }
            return errors
        }
    }
}
</script>

<style scoped>
ul {
    list-style: none;
    color: red;
    font-weight: bold;
    font-size: 0.7rem;
    padding-inline-start: 0;
    margin-block-start: 0;
    margin-block-end: 5px;
}
</style>