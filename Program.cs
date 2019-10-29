using System;
using MySql.Data.MySqlClient;

namespace PETMonitor{
    public class dados
    {
        string dadosSQL = "server=127.0.0.1;port=3306;uid=root;password=;database=petmonitor";
        public int value = 0;
        public void SendSQL(string comandoSQL)
        {
            MySqlConnection conexao = new MySqlConnection(dadosSQL);
            string procura = comandoSQL;
            MySqlCommand comando = new MySqlCommand(procura, conexao);
            conexao.Open();
            MySqlDataReader ler = comando.ExecuteReader();
        }
        public void select(string id)
        {
            MySqlConnection conexao = new MySqlConnection(dadosSQL);
            string procura = String.Format("Select * from pets where id='{0}'", id);
            MySqlCommand comando = new MySqlCommand(procura, conexao);
            conexao.Open();
            MySqlDataReader ler = comando.ExecuteReader();

            while (ler.Read())
            {
                Console.Write(ler["id"].ToString() + " ");
                Console.Write(ler["tipo_pet"].ToString() + " ");
                Console.Write(ler["nome_pet"].ToString() + " ");
                Console.Write(ler["lat"].ToString() + " ");
                Console.Write(ler["long"].ToString() + " ");
                Console.Write(ler["lat_final"].ToString() + " ");
                Console.Write(ler["long_final"].ToString() + " ");
                Console.WriteLine(ler["hora_vista"].ToString());
            }
        }
        public void update(string tipo, string nome, string id)
        {
            string procura = String.Format("Update pets set tipo_pet='{0}', nome_pet='{1}' where id='{2}'", tipo,nome,id);
            SendSQL(procura);
        }
        public void delete(string id)
        {
            string procura = String.Format("DELETE FROM pets WHERE id='{0}'", id);
            SendSQL(procura);
        }
        public void insert(string tipo, string nome)
        {
            string procura = String.Format("INSERT INTO pets (`tipo_pet`, `nome_pet`, `lat`, `long`, `lat_final`, `long_final`, `data_inicio`, `data_fim`, `hora_vista`)" +
                "VALUES('{0}', '{1}', '0', '0', '0', '0', '2019-01-01', '2019-01-01', '00:00:00')", tipo, nome);
            SendSQL(procura);
        }
    }

    class Program{
        static void Main(string[] args)
        {
            string idPet;
            string nome;
            string tipo;
            var dados = new dados();
            string sair = "";
            do{
                Console.WriteLine("Olá o que deseja fazer?");
                Console.WriteLine("1 = Consultar");
                Console.WriteLine("2 = Alterar pet");
                Console.WriteLine("3 = Remover pet");
                Console.WriteLine("4 = Adicionar pet");

                Int32.TryParse(Console.ReadLine(), out dados.value);

                switch (dados.value)
                {
                    case 1:
                        Console.WriteLine("Digite o ID do animal:");
                        idPet = Console.ReadLine();
                        dados.select(idPet);
                        break;
                    case 2:
                        Console.WriteLine("Digite o ID do animal:");
                        idPet = Console.ReadLine();
                        dados.select(idPet);
                        Console.WriteLine("");
                        Console.WriteLine("Digite o tipo do animal:");
                        tipo = Console.ReadLine();
                        Console.WriteLine("Digite o nome do animal:");
                        nome = Console.ReadLine();
                        dados.update(tipo,nome,idPet);
                        Console.WriteLine("Atualizado com sucesso!!");
                        dados.select(idPet);
                        break;
                    case 3:
                        Console.WriteLine("Digite o ID do animal:");
                        idPet = Console.ReadLine();
                        Console.WriteLine("Os dados do animal nunca poderam ser recuperados tem certeza? Digite 'sim'");
                        string N = Console.ReadLine();
                        if (N == "sim"){
                            dados.delete(idPet);
                        }
                        break;
                    case 4:
                        Console.WriteLine("Digite o tipo do animal:");
                        tipo = Console.ReadLine();
                        Console.WriteLine("Digite o nome do animal:");
                        nome = Console.ReadLine();
                        Console.WriteLine("Atualizado com sucesso!!");
                        dados.insert(tipo, nome);
                        break;
                    default:
                        Console.WriteLine("Erro na escrita!");
                        break;
                }

                Console.WriteLine("Aperte ENTER para sair, ou escreva '0' para continuar");
                sair = Console.ReadLine();
                Console.Clear();
            }
            while (sair == "0");
        }
    }
}
