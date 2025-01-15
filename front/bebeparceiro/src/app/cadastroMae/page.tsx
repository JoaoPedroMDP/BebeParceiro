'use client';
import Button from '@/components/inputs/base/button';
import Text from '@/components/inputs/base/text';
import Image from 'next/image';
import { useState } from 'react';

export default function Page() {
    const [code, setCode] = useState<string>("");
    return (
        <div className="flex flex-col items-center justify-center gap-3">
            <Image src="/bp-logo.png" alt="Logo" width={200} height={200} />
            <p>Antes de continuarmos o seu cadastro, por favor, digite o código de acesso fornecido pela voluntária do projeto.</p>
            <Text value={code} label="Código de Acesso" changeHandler={setCode} required placeholder={"ABC123DEF"}/>
            <Button label="Continuar" clickHandler={() => {}}/>
        </div>
    );
}