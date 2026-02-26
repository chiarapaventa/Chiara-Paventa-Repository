/**********************************************************************/
/*   ____  ____                                                       */
/*  /   /\/   /                                                       */
/* /___/  \  /                                                        */
/* \   \   \/                                                       */
/*  \   \        Copyright (c) 2003-2009 Xilinx, Inc.                */
/*  /   /          All Right Reserved.                                 */
/* /---/   /\                                                         */
/* \   \  /  \                                                      */
/*  \___\/\___\                                                    */
/***********************************************************************/

/* This file is designed for use with ISim build 0x8ef4fb42 */

#define XSI_HIDE_SYMBOL_SPEC true
#include "xsi.h"
#include <memory.h>
#ifdef __GNUC__
#include <stdlib.h>
#else
#include <malloc.h>
#define alloca _alloca
#endif
static const char *ng0 = "C:/Users/Chiara/Desktop/Progetti/MajorityProva/tb_MajorityProva.vhd";



static void work_a_0061616790_2372691052_p_0(char *t0)
{
    char *t1;
    char *t2;
    char *t3;
    char *t4;
    char *t5;
    char *t6;
    int64 t7;
    unsigned char t8;
    unsigned char t9;
    int t10;
    int t11;

LAB0:    t1 = (t0 + 1596U);
    t2 = *((char **)t1);
    if (t2 == 0)
        goto LAB2;

LAB3:    goto *t2;

LAB2:    xsi_set_current_line(97, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(98, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(99, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(100, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB6:    *((char **)t1) = &&LAB7;

LAB1:    return;
LAB4:    xsi_set_current_line(101, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)2);
    if (t9 == 0)
        goto LAB8;

LAB9:    xsi_set_current_line(102, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)2);
    if (t9 != 0)
        goto LAB10;

LAB12:
LAB11:    xsi_set_current_line(107, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(108, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(109, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(110, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB15:    *((char **)t1) = &&LAB16;
    goto LAB1;

LAB5:    goto LAB4;

LAB7:    goto LAB5;

LAB8:    t2 = (t0 + 3624);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB9;

LAB10:    xsi_set_current_line(103, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB11;

LAB13:    xsi_set_current_line(111, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)2);
    if (t9 == 0)
        goto LAB17;

LAB18:    xsi_set_current_line(112, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)2);
    if (t9 != 0)
        goto LAB19;

LAB21:
LAB20:    xsi_set_current_line(116, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(117, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(118, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(119, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB24:    *((char **)t1) = &&LAB25;
    goto LAB1;

LAB14:    goto LAB13;

LAB16:    goto LAB14;

LAB17:    t2 = (t0 + 3630);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB18;

LAB19:    xsi_set_current_line(113, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB20;

LAB22:    xsi_set_current_line(120, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)2);
    if (t9 == 0)
        goto LAB26;

LAB27:    xsi_set_current_line(121, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)2);
    if (t9 != 0)
        goto LAB28;

LAB30:
LAB29:    xsi_set_current_line(125, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(126, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(127, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(128, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB33:    *((char **)t1) = &&LAB34;
    goto LAB1;

LAB23:    goto LAB22;

LAB25:    goto LAB23;

LAB26:    t2 = (t0 + 3636);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB27;

LAB28:    xsi_set_current_line(122, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB29;

LAB31:    xsi_set_current_line(129, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)3);
    if (t9 == 0)
        goto LAB35;

LAB36:    xsi_set_current_line(130, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)3);
    if (t9 != 0)
        goto LAB37;

LAB39:
LAB38:    xsi_set_current_line(134, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(135, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(136, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(137, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB42:    *((char **)t1) = &&LAB43;
    goto LAB1;

LAB32:    goto LAB31;

LAB34:    goto LAB32;

LAB35:    t2 = (t0 + 3642);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB36;

LAB37:    xsi_set_current_line(131, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB38;

LAB40:    xsi_set_current_line(138, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)2);
    if (t9 == 0)
        goto LAB44;

LAB45:    xsi_set_current_line(139, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)2);
    if (t9 != 0)
        goto LAB46;

LAB48:
LAB47:    xsi_set_current_line(143, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(144, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(145, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(146, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB51:    *((char **)t1) = &&LAB52;
    goto LAB1;

LAB41:    goto LAB40;

LAB43:    goto LAB41;

LAB44:    t2 = (t0 + 3648);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB45;

LAB46:    xsi_set_current_line(140, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB47;

LAB49:    xsi_set_current_line(147, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)3);
    if (t9 == 0)
        goto LAB53;

LAB54:    xsi_set_current_line(148, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)3);
    if (t9 != 0)
        goto LAB55;

LAB57:
LAB56:    xsi_set_current_line(153, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(154, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(155, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)2;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(156, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB60:    *((char **)t1) = &&LAB61;
    goto LAB1;

LAB50:    goto LAB49;

LAB52:    goto LAB50;

LAB53:    t2 = (t0 + 3654);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB54;

LAB55:    xsi_set_current_line(149, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB56;

LAB58:    xsi_set_current_line(157, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)3);
    if (t9 == 0)
        goto LAB62;

LAB63:    xsi_set_current_line(158, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)3);
    if (t9 != 0)
        goto LAB64;

LAB66:
LAB65:    xsi_set_current_line(163, ng0);
    t2 = (t0 + 1828);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(164, ng0);
    t2 = (t0 + 1864);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(165, ng0);
    t2 = (t0 + 1900);
    t3 = (t2 + 32U);
    t4 = *((char **)t3);
    t5 = (t4 + 40U);
    t6 = *((char **)t5);
    *((unsigned char *)t6) = (unsigned char)3;
    xsi_driver_first_trans_fast(t2);
    xsi_set_current_line(166, ng0);
    t7 = (10 * 1000LL);
    t2 = (t0 + 1496);
    xsi_process_wait(t2, t7);

LAB69:    *((char **)t1) = &&LAB70;
    goto LAB1;

LAB59:    goto LAB58;

LAB61:    goto LAB59;

LAB62:    t2 = (t0 + 3660);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB63;

LAB64:    xsi_set_current_line(159, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB65;

LAB67:    xsi_set_current_line(167, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 == (unsigned char)3);
    if (t9 == 0)
        goto LAB71;

LAB72:    xsi_set_current_line(168, ng0);
    t2 = (t0 + 868U);
    t3 = *((char **)t2);
    t8 = *((unsigned char *)t3);
    t9 = (t8 != (unsigned char)3);
    if (t9 != 0)
        goto LAB73;

LAB75:
LAB74:    goto LAB2;

LAB68:    goto LAB67;

LAB70:    goto LAB68;

LAB71:    t2 = (t0 + 3666);
    xsi_report(t2, 6U, (unsigned char)2);
    goto LAB72;

LAB73:    xsi_set_current_line(169, ng0);
    t2 = (t0 + 1040U);
    t4 = *((char **)t2);
    t10 = *((int *)t4);
    t11 = (t10 + 1);
    t2 = (t0 + 1040U);
    t5 = *((char **)t2);
    t2 = (t5 + 0);
    *((int *)t2) = t11;
    goto LAB74;

}


extern void work_a_0061616790_2372691052_init()
{
	static char *pe[] = {(void *)work_a_0061616790_2372691052_p_0};
	xsi_register_didat("work_a_0061616790_2372691052", "isim/tb_MajorityProva_isim_beh.exe.sim/work/a_0061616790_2372691052.didat");
	xsi_register_executes(pe);
}
