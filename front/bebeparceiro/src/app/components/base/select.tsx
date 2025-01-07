'use client';
interface SelectProps {
    label: string;
    value: string;
    changeHandler: (value: string) => void;
    options: string[];
    required?: boolean;
}

export default function Select(props: Readonly<SelectProps>) {
    const required = props.required !== undefined;

    function changeContent(newContent: string) {
        props.changeHandler(newContent);
    }

    function handleChange(event: React.ChangeEvent<HTMLSelectElement>) {
        const value = event.target.value;

        changeContent(value);
    }

    // Defino o asterisco de campo obrigatório.
    let requiredMark = required ? "after:content-['*'] after:font-bold after:text-wrongRed" : '';

    return (
        <div className="m-3 relative flex flex-col w-full">
            <span className={`absolute px-1 left-2 -top-2 leading-none touch-pan-down bg-white ${requiredMark}`}>{props.label}</span>
            <select
                id={props.label}
                name={props.label}
                className={`border-2 border-black rounded-md p-2 bg-white`}
                value={props.value}
                onChange={handleChange}
            >
                {props.options.map((option) => (
                    <option key={option} value={option} className="border-2 border-black">{option}</option>
                ))}
            </select>
        </div>
    );
}