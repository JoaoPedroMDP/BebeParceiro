'use client';
import TextLink from "./inputs/base/textLink";
import { useRouter } from 'next/navigation';

export default function NavBar() {
    const router = useRouter();

    return (
        <div className="sticky bg-lightGreen flex flex-row gap-6">
            <TextLink label={"Login"} handleClick={() => {router.push('/login')}} />
            <TextLink label={"Cadastro Mãe"} handleClick={() => {router.push('/cadastroMae')}} />
            <TextLink label={"Cadastro Profissional"} handleClick={() => {router.push('/cadastroProfissional')}} />
        </div>
    );
}