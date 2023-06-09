PGDMP     ;                    {            pdv    15.2    15.2 &                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            !           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            "           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            #           1262    16398    pdv    DATABASE     z   CREATE DATABASE pdv WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE pdv;
                postgres    false            $           0    0    DATABASE pdv    COMMENT     P   COMMENT ON DATABASE pdv IS 'Banco de Dados para API REST de um PONTO DE VENDA';
                   postgres    false    3363            �            1259    16410 	   categoria    TABLE     �   CREATE TABLE public.categoria (
    cate_id integer NOT NULL,
    cate_nome character varying(255) NOT NULL,
    cate_imposto double precision NOT NULL,
    created_at date NOT NULL,
    updated_at date NOT NULL
);
    DROP TABLE public.categoria;
       public         heap    postgres    false            �            1259    16409    categoria_cate_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categoria_cate_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.categoria_cate_id_seq;
       public          postgres    false    217            %           0    0    categoria_cate_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.categoria_cate_id_seq OWNED BY public.categoria.cate_id;
          public          postgres    false    216            �            1259    16427    pedido    TABLE       CREATE TABLE public.pedido (
    pedi_id integer NOT NULL,
    pedi_valo_bruto double precision NOT NULL,
    pedi_valor_liquido double precision NOT NULL,
    pedi_valor_imposto double precision NOT NULL,
    created_at date NOT NULL,
    updated_at date NOT NULL
);
    DROP TABLE public.pedido;
       public         heap    postgres    false            �            1259    16433    pedido_item    TABLE     W  CREATE TABLE public.pedido_item (
    pdit_qtd bigint NOT NULL,
    pdit_valor_bruto double precision NOT NULL,
    pdit_valor_liquido double precision NOT NULL,
    pdit_valor_imposto double precision NOT NULL,
    created_at date NOT NULL,
    updated_at date NOT NULL,
    pdit_produto integer NOT NULL,
    pdit_pedido integer NOT NULL
);
    DROP TABLE public.pedido_item;
       public         heap    postgres    false            �            1259    16426    pedido_pedi_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pedido_pedi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.pedido_pedi_id_seq;
       public          postgres    false    219            &           0    0    pedido_pedi_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.pedido_pedi_id_seq OWNED BY public.pedido.pedi_id;
          public          postgres    false    218            �            1259    16399    produto    TABLE     �   CREATE TABLE public.produto (
    prod_id integer NOT NULL,
    prod_nome character varying(255) NOT NULL,
    prod_preco double precision NOT NULL,
    created_at date NOT NULL,
    updated_at date NOT NULL,
    prod_categoria integer
);
    DROP TABLE public.produto;
       public         heap    postgres    false            �            1259    16402    produto_prod_id_seq    SEQUENCE     �   CREATE SEQUENCE public.produto_prod_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.produto_prod_id_seq;
       public          postgres    false    214            '           0    0    produto_prod_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.produto_prod_id_seq OWNED BY public.produto.prod_id;
          public          postgres    false    215            �            1259    16447    tokens_auth    TABLE     �   CREATE TABLE public.tokens_auth (
    id integer NOT NULL,
    toke_token character varying(500) NOT NULL,
    toke_status character varying(255)
);
    DROP TABLE public.tokens_auth;
       public         heap    postgres    false            �            1259    16446    tokens_auth_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tokens_auth_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tokens_auth_id_seq;
       public          postgres    false    222            (           0    0    tokens_auth_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tokens_auth_id_seq OWNED BY public.tokens_auth.id;
          public          postgres    false    221            y           2604    16413    categoria cate_id    DEFAULT     v   ALTER TABLE ONLY public.categoria ALTER COLUMN cate_id SET DEFAULT nextval('public.categoria_cate_id_seq'::regclass);
 @   ALTER TABLE public.categoria ALTER COLUMN cate_id DROP DEFAULT;
       public          postgres    false    216    217    217            z           2604    16430    pedido pedi_id    DEFAULT     p   ALTER TABLE ONLY public.pedido ALTER COLUMN pedi_id SET DEFAULT nextval('public.pedido_pedi_id_seq'::regclass);
 =   ALTER TABLE public.pedido ALTER COLUMN pedi_id DROP DEFAULT;
       public          postgres    false    218    219    219            x           2604    16403    produto prod_id    DEFAULT     r   ALTER TABLE ONLY public.produto ALTER COLUMN prod_id SET DEFAULT nextval('public.produto_prod_id_seq'::regclass);
 >   ALTER TABLE public.produto ALTER COLUMN prod_id DROP DEFAULT;
       public          postgres    false    215    214            {           2604    16450    tokens_auth id    DEFAULT     p   ALTER TABLE ONLY public.tokens_auth ALTER COLUMN id SET DEFAULT nextval('public.tokens_auth_id_seq'::regclass);
 =   ALTER TABLE public.tokens_auth ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    222    222                      0    16410 	   categoria 
   TABLE DATA                 public          postgres    false    217   �)                 0    16427    pedido 
   TABLE DATA                 public          postgres    false    219   W*                 0    16433    pedido_item 
   TABLE DATA                 public          postgres    false    220   +                 0    16399    produto 
   TABLE DATA                 public          postgres    false    214   �+                 0    16447    tokens_auth 
   TABLE DATA                 public          postgres    false    222   �,       )           0    0    categoria_cate_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.categoria_cate_id_seq', 13, true);
          public          postgres    false    216            *           0    0    pedido_pedi_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.pedido_pedi_id_seq', 12, true);
          public          postgres    false    218            +           0    0    produto_prod_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.produto_prod_id_seq', 24, true);
          public          postgres    false    215            ,           0    0    tokens_auth_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tokens_auth_id_seq', 1, true);
          public          postgres    false    221                       2606    16415    categoria categoria_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (cate_id);
 B   ALTER TABLE ONLY public.categoria DROP CONSTRAINT categoria_pkey;
       public            postgres    false    217            �           2606    16432    pedido pedido_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_pkey PRIMARY KEY (pedi_id);
 <   ALTER TABLE ONLY public.pedido DROP CONSTRAINT pedido_pkey;
       public            postgres    false    219            }           2606    16408    produto produto_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.produto
    ADD CONSTRAINT produto_pkey PRIMARY KEY (prod_id);
 >   ALTER TABLE ONLY public.produto DROP CONSTRAINT produto_pkey;
       public            postgres    false    214            �           2606    16452    tokens_auth tokens_auth_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tokens_auth
    ADD CONSTRAINT tokens_auth_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.tokens_auth DROP CONSTRAINT tokens_auth_pkey;
       public            postgres    false    222            �           2606    16465    produto fk_categoria    FK CONSTRAINT     �   ALTER TABLE ONLY public.produto
    ADD CONSTRAINT fk_categoria FOREIGN KEY (prod_categoria) REFERENCES public.categoria(cate_id) ON DELETE RESTRICT NOT VALID;
 >   ALTER TABLE ONLY public.produto DROP CONSTRAINT fk_categoria;
       public          postgres    false    217    214    3199            �           2606    16455    pedido_item fk_pedido    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedido_item
    ADD CONSTRAINT fk_pedido FOREIGN KEY (pdit_pedido) REFERENCES public.pedido(pedi_id) ON DELETE CASCADE NOT VALID;
 ?   ALTER TABLE ONLY public.pedido_item DROP CONSTRAINT fk_pedido;
       public          postgres    false    219    3201    220            �           2606    16460    pedido_item fk_produto    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedido_item
    ADD CONSTRAINT fk_produto FOREIGN KEY (pdit_produto) REFERENCES public.produto(prod_id) ON DELETE CASCADE NOT VALID;
 @   ALTER TABLE ONLY public.pedido_item DROP CONSTRAINT fk_produto;
       public          postgres    false    220    214    3197               �   x���K�@ཿ��Fa�yT�"\a��V�1������I��iW�ι���I�,>吤�����*���\M���X蚂w�6S�mg���ol�5P�z�\v�s��/)���$X��7���� �[/��i�L+g�3�6�$�C��Q�c�7�%	n�pa,��y,��d��yO����         �   x���v
Q���W((M��L�+HM�L�W� ��):
`FYbN~|RQiI>�@Q|Nfa)P5�XfnA~1H]rQjbIjJ|b��BiA
��������a��`h`��`�F@�nd`d�k`�kd���Ӵ��H�]h"M�,,tL��@bx]�� {�k/         �   x���O�0 ���RXC7M�SB��*�<�M�}��
���1�Ã����~l�f���o[�c�ʚ�FH�
i�\-�)z#ܲK٪���Ѩ�J+�7��d�����CS�F�!0j��o�zP�y��nN��1ۃ�F� �1������W#�zK'�D�h���ȧ�N�.Ƭ��a�I1�&�}4j��`1�i?W��0��9�ؗ2ǹ��         �   x���A�0໿⻩0�m)H���H�*��TC��H����~����M[�:��� z��%K�Q|D.��#��S=��L!`F���0"�4������b���窅���;	�,�d�&M��}6o�zM"����H��r����>����I4�n�-/&?�q         w   x���v
Q���W((M��L�+��N�+�O,-�P��L�Q 	ăE���Ē�bM�0G�P�`C�D��4�#�D3#C]���4]�4#ݴ�$��$#c��u���̲|uMk... �%�     