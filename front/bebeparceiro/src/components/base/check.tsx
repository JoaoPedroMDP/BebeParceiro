interface CheckProps {
    label: string;
    value: boolean;
    changeHandler: (value: boolean) => void;
}

export default function Check(props: Readonly<CheckProps>) {
    return (
        <div className="m-3 relative flex flex-row w-full gap-2">
            <input type="checkbox" id={props.label} checked={props.value} onChange={(event) => props.changeHandler(event.target.checked)} />
            <label htmlFor={props.label}>{props.label}</label>
        </div>
    );
}