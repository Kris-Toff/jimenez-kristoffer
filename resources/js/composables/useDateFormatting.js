import dayjs from "dayjs";

export function useDateFormatting() {
    const humanizeDay = (date1, date2) => {
        if (!date1) return date1;
        if (!date2) return date2;

        const selectedDate = dayjs(date1);
        const diffDays = dayjs(date2).diff(selectedDate, "day");
        const strDay = diffDays >= 2 ? "days" : "day";

        return `${diffDays} ${strDay} from now`;
    };

    const humanizeTime = (date1, date2) => {
        if (!date1) return date1;
        if (!date2) return date2;

        const selectedDate = dayjs(date1);
        const diffTime = dayjs(date2).diff(selectedDate, "minute");
        const strTime = diffTime >= 2 ? "mins" : "min";

        return `${diffTime} ${strTime}`;
    };

    const dayDateTimeString = (date) => {
        if (!date) return date;

        const selectedDate = dayjs(date).format("ddd, MMM D, YYYY hh:mm a");

        return `${selectedDate}`;
    };

    return { humanizeDay, humanizeTime, dayDateTimeString };
}
