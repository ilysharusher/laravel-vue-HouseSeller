import { computed, isRef } from 'vue';

const useMonthlyPayment = (total, interestRate, duration) => {
    const monthlyPayment = computed(() => {
        const price = isRef(total) ? total.value : total;
        const interest = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12;
        const payments = (isRef(duration) ? duration.value : duration) * 12;

        const x = Math.pow(1 + interest, payments);
        const monthly = (price * x * interest) / (x - 1);

        return monthly.toFixed(2);
    });

    const totalPaid = computed(() => {
        return (isRef(duration) ? duration.value : duration) * 12 * monthlyPayment.value;
    });

    const totalInterest = computed(() => totalPaid.value - (isRef(total) ? total.value : total));

    return { monthlyPayment, totalPaid, totalInterest };
};

export default useMonthlyPayment;
