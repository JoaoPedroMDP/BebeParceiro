'use client';
import { SelectOption } from '@/app/types';
import { useEffect, useState } from 'react';
import ReactSelect from 'react-select';

interface SelectProps {
    label: string;
    value: string;
    changeHandler: (value: string) => void;
    options: SelectOption[];
    required?: boolean;
}

export default function Select(props: Readonly<SelectProps>) {
    const [isClient, setIsClient] = useState(false)
    useEffect(() => {
        setIsClient(true);
    }, []);
    
    const required = props.required !== undefined;

    function changeContent(newContent: string) {
        props.changeHandler(newContent);
    }

    // Defino o asterisco de campo obrigatório.
    let requiredMark = required ? "after:content-['*'] after:font-bold after:text-wrongRed" : '';

    return (
        <div className="m-3 relative flex flex-col w-full">

            {isClient &&
            <div>
                <span className={`absolute z-10 px-1 left-2 -top-2 leading-none touch-pan-down bg-white ${requiredMark}`}>{props.label}</span>
                <ReactSelect
                    styles={{
                        control: (baseStyles, state) => ({
                            ...baseStyles,
                            borderColor: 'black',
                            borderWidth: '2px',
                            borderRadius: '7px',
                            outline: state.isFocused ? 'dashed': 'none',
                            outlineColor: 'blue',
                            ":hover": {
                                borderColor: 'black',
                            },
                        })
                    }} 
                    options={props.options}
                    onChange={(option) => changeContent(option?.value ?? '')}
                />
            </div>
            }
        </div>
    );
}